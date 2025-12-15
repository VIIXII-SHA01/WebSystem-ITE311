<?= $this->include('templates/header') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Material</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(94, 114, 228, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
            animation: pulse 8s ease-in-out infinite;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
            animation: pulse 6s ease-in-out infinite;
            animation-delay: 2s;
            z-index: 0;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.3; }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .upload-card {
            background: rgba(33, 37, 41, 0.8) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 1rem;
        }

        .upload-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6);
        }

        h1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .form-control {
            background: rgba(33, 37, 41, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            padding: 12px 16px;
            color: #fff !important;
        }

        .form-control:focus {
            background: rgba(33, 37, 41, 0.8) !important;
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
        }

        .form-control::file-selector-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            margin-right: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control::file-selector-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            margin-bottom: 8px;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
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
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .alert {
            border: none;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
            border-left: 4px solid #dc3545;
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.2);
            color: #51cf66;
            border-left: 4px solid #198754;
        }

        .upload-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .file-info {
            background: rgba(102, 126, 234, 0.1);
            border: 1px solid rgba(102, 126, 234, 0.3);
            border-radius: 8px;
            padding: 12px;
            margin-top: 1rem;
            color: #fff;
        }

        @media (max-width: 576px) {
            body::before, body::after {
                width: 300px;
                height: 300px;
            }
        }
    </style>
</head>
<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    <div class="upload-card p-4 p-md-5" style="max-width: 600px; width: 100%;">
        <div class="text-center mb-4">
            <i class="bi bi-cloud-upload upload-icon"></i>
            <h1 class="text-white mb-2">Upload Material</h1>
            <p class="text-white-50">Share educational resources with your students</p>
        </div>

        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <!-- Upload Form -->
        <form action="<?= base_url('/teacher/course') ?>" method="post" enctype="multipart/form-data" id="uploadForm">
            <?= csrf_field() ?>
            
            <div class="mb-4">
                <label for="material_file" class="form-label">
                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Select File
                </label>
                <input 
                    type="file" 
                    name="material_file" 
                    id="material_file"
                    class="form-control bg-dark text-white" 
                    required
                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.jpg,.jpeg,.png">
                <small class="text-white-50 mt-2 d-block">
                    Accepted formats: PDF, DOC, PPT, XLS, ZIP, Images (Max: 10MB)
                </small>
            </div>

            <div class="file-info d-none" id="fileInfo">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    <span id="fileName"></span>
                </div>
                <small class="text-white-50 mt-1 d-block" id="fileSize"></small>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">
                <i class="bi bi-upload me-2"></i>Upload Material
            </button>
        </form>
    </div>
</div>

<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>

<script>
    document.getElementById('material_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        
        if (file) {
            fileName.textContent = file.name;
            fileSize.textContent = `Size: ${(file.size / 1024 / 1024).toFixed(2)} MB`;
            fileInfo.classList.remove('d-none');
        } else {
            fileInfo.classList.add('d-none');
        }
    });
</script>

</body>
</html>;p-