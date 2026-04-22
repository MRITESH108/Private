<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <?php $this->load->view('sections/header') ?>
</head>

<body style="
background: 
linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
url('<?= base_url('assets/img/slider1.jpeg') ?>') 
no-repeat center center / cover;
">
    <?php $this->load->view('/pages/navbar_page') ?>

    <div class="login-wrapper">

        <div class="login-box">

            <h2 class="login-title">Municipal Corporation</h2>
            <p class="login-subtitle">Official Login Portal</p>

            <!-- FORM -->
            <form method="post" action="<?= base_url('LoginController/login') ?>">

                <!-- USERNAME -->
                <input
                    type="text"
                    name="username"
                    value="<?= set_value('username'); ?>"
                    placeholder="Enter Email"
                    class="login-input">
                <div class="field-error">
                    <?= form_error('username'); ?>
                </div>

                <!-- PASSWORD -->
                <input
                    type="password"
                    name="password"
                    placeholder="Enter Password"
                    class="login-input">
                <div class="field-error">
                    <?= form_error('password'); ?>
                </div>

                <!-- GLOBAL ERROR (wrong credentials) -->
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="field-error">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="login-btn">
                    Sign In
                </button>

            </form>

        </div>

    </div>

</body>

</html>