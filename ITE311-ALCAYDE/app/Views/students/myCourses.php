<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Tokens for AJAX -->
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-hash" content="<?= csrf_hash() ?>">
    <link rel="stylesheet" href="<?= base_url('styles.css') ?>">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title><?= esc(session()->get('user_role')) ?> | Courses</title>
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(94, 114, 228, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: pulse 10s ease-in-out infinite;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: pulse 8s ease-in-out infinite;
            animation-delay: 2s;
            pointer-events: none;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.15); opacity: 0.3; }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        h2 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        #alert-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            width: 350px;
        }

        #alert-container .alert {
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInRight 0.5s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.3) !important;
            color: #51cf66 !important;
            border-left: 4px solid #198754 !important;
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.3) !important;
            color: #ffd43b !important;
            border-left: 4px solid #ffc107 !important;
        }

        .card {
            background: rgba(33, 37, 41, 0.8) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            border-radius: 1rem 1rem 0 0 !important;
            padding: 1.25rem;
        }

        .card-header h5 {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header.bg-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
        }

        .card-body {
            color: white;
        }

        .list-group-item {
            background: rgba(33, 37, 41, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
            border-radius: 0.5rem !important;
            margin-bottom: 0.75rem;
        }

        .list-group-item:hover {
            background: rgba(102, 126, 234, 0.2) !important;
            transform: translateX(5px);
            border-color: rgba(102, 126, 234, 0.5) !important;
        }

        .list-group-item strong {
            color: #667eea;
            font-size: 1.1rem;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
            box-shadow: 0 4px 15px rgba(25, 135, 84, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:disabled {
            background: rgba(102, 126, 234, 0.5);
            cursor: not-allowed;
        }

        .btn-success {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
            border: none !important;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .list-group {
            gap: 0.5rem;
        }

        .list-group-flush .list-group-item {
            border-width: 0 !important;
        }

        @media (max-width: 768px) {
            body::before, body::after {
                width: 400px;
                height: 400px;
            }

            #alert-container {
                width: 90%;
                right: 5%;
            }

            h2 {
                font-size: 1.75rem;
            }
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
            <h5 class="mb-0">
                <i class="bi bi-bookmark-check"></i>
                My Enrolled Courses
            </h5>
        </div>
        <div class="card-body p-4">
    <?php if (!empty($enrollments)): ?>
        <ul id="enrolledCourses" class="list-group list-group-flush">
            <?php foreach ($enrollments as $enroll): ?>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2">
                    <span>
                        <strong><?= esc($enroll['course_name']); ?></strong><br>
                        <small class="text-muted">
                            <i class="bi bi-person"></i> Instructor: <?= esc($enroll['course_instructor'] ?? 'Not assigned'); ?>
                        </small>
                    </span>
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle"></i> Enrolled
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted text-center">
            <i class="bi bi-info-circle"></i> You haven't enrolled in any courses yet.
        </p>
    <?php endif; ?>
</div>
    </div>

    <!-- Available Courses -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">
                <i class="bi bi-book"></i>
                Available Courses
            </h5>
        </div>
        <div class="card-body">
            <?php if (!empty($availableCourses)): ?>
                <ul class="list-group">
                    <?php foreach ($availableCourses as $course): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= esc($course['course_name']); ?></strong><br>
                                <small class="text-muted">
                                    <i class="bi bi-person"></i> Instructor: <?= esc($course['course_instructor'] ?? 'Not assigned'); ?>
                                </small>
                            </div>
                            <button class="btn btn-primary enrollBtn" data-course-id="<?= $course['id']; ?>">
                                <i class="bi bi-plus-circle"></i> Enroll
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted text-center">
                    <i class="bi bi-info-circle"></i> No available courses found.
                </p>
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

            btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Enrolling...');

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
                    const icon = res.status === 'success' ? 'check-circle' : 'exclamation-triangle';
                    const alertEl = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                                    '<i class="bi bi-' + icon + '"></i> ' +
                                    $('<div>').text(res.message).html() +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                    $('#alert-container').append(alertEl);
                    setTimeout(() => alertEl.alert('close'), 3000);

                    if (res.status === 'success') {
                        btn.removeClass('btn-primary').addClass('btn-success').html('<i class="bi bi-check-circle"></i> Enrolled');
                        const courseListItem = btn.closest('li').clone();
                        courseListItem.find('.enrollBtn').remove();
                        if (!courseListItem.find('.badge').length) {
                            courseListItem.append('<span class="badge bg-success ms-2"><i class="bi bi-check-circle"></i> Enrolled</span>');
                        }
                        $('#enrolledCourses').append(courseListItem);
                    } else {
                        btn.prop('disabled', false).html('<i class="bi bi-plus-circle"></i> Enroll');
                    }
                },
                error: function(xhr) {
                    try {
                        const json = JSON.parse(xhr.responseText);
                        if (json.csrfHash) updateCsrf(json.csrfHash);
                    } catch (ignored) {}
                    alert('An error occurred while enrolling. Please try again.');
                    btn.prop('disabled', false).html('<i class="bi bi-plus-circle"></i> Enroll');
                }
            });
        });
    });
</script>
</body>
</html>