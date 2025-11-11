<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Tokens for AJAX -->
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-hash" content="<?= csrf_hash() ?>">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title><?= esc(session()->get('user_role')) ?> | Courses</title>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: hsl(219, 12%, 23%, 1.00);
        }
        #min {
            margin-top: 20px;
        }

        /* Fixed alert container */
        #alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
        }
        #alert-container .alert {
            pointer-events: auto;
            min-width: 300px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- ✅ Fixed alert container -->
<div id="alert-container"></div>

<div class="container py-5">
   <h2 class="mb-4 text-center fw-bold text-white">Student Dashboard</h2>

    <!-- Enrolled Courses -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">My Enrolled Courses</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($enrollments)): ?>
                <ul id="enrolledCourses" class="list-group">
                    <?php foreach ($enrollments as $enroll): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong><?= esc($enroll['course_name']); ?></strong><br>
                                <small class="text-muted">Instructor: <?= esc($enroll['course_instructor'] ?? ''); ?></small>
                            </span>
                            <span class="badge bg-success">Enrolled</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">You haven’t enrolled in any courses yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Available Courses -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Available Courses</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($availableCourses)): ?>
                <ul class="list-group">
                    <?php foreach ($availableCourses as $course): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= esc($course['course_name']); ?></strong><br>
                                <small class="text-muted">Instructor: <?= esc($course['course_instructor'] ?? ''); ?></small>
                            </div>
                            <button class="btn btn-primary enrollBtn" data-course-id="<?= $course['id']; ?>">
                                Enroll
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No available courses found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- AJAX Script -->
<script>
    $(function() {
        let csrfName = $('meta[name="csrf-token-name"]').attr('content');
        let csrfHash = $('meta[name="csrf-token-hash"]').attr('content');

        function updateCsrf(newHash) {
            if (newHash) {
                csrfHash = newHash;
                $('meta[name="csrf-token-hash"]').attr('content', newHash);
            }
        }

        $('.enrollBtn').on('click', function(e) {
            e.preventDefault();

            const btn = $(this);
            const courseId = btn.data('course-id');

            if (!courseId) return alert('Invalid course ID.');

            btn.prop('disabled', true).text('Enrolling...');

            // Create payload with correct CSRF key
            let payload = {};
            payload['course_id'] = courseId;
            payload[csrfName] = csrfHash; // key must match current token name

            $.ajax({
                url: '<?= site_url('course/enroll') ?>',
                type: 'POST',
                data: payload,
                dataType: 'json',
                success: function(res) {
                    if (res.csrfHash) updateCsrf(res.csrfHash); // update token for next request

                    // Create alert
                    const alertClass = res.status === 'success' ? 'alert-success' : 'alert-warning';
                    const alertEl = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                                    $('<div>').text(res.message).html() +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                    $('#alert-container').append(alertEl);
                    setTimeout(() => alertEl.alert('close'), 3000);

                    if (res.status === 'success') {
                        btn.removeClass('btn-primary').addClass('btn-success').text('Enrolled');
                        const courseListItem = btn.closest('li').clone();
                        courseListItem.find('.enrollBtn').remove();
                        if (!courseListItem.find('.badge').length) {
                            courseListItem.append('<span class="badge bg-success ms-2">Enrolled</span>');
                        }
                        $('#enrolledCourses').append(courseListItem);
                    } else {
                        btn.prop('disabled', false).text('Enroll');
                    }
                },
                error: function(xhr) {
                    try {
                        const json = JSON.parse(xhr.responseText);
                        if (json.csrfHash) updateCsrf(json.csrfHash);
                    } catch (ignored) {}
                    alert('An error occurred while enrolling. Please try again.');
                    btn.prop('disabled', false).text('Enroll');
                }
            });
        });
    });
</script>
</body>
</html>
