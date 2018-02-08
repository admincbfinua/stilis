<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


 <div class="login">
            <div class="container">
                <div class="login-grids">
                    <div class="col-md-6 log">
                             <h3>Login</h3>
                             <div class="strip"></div>
                             <p>Welcome, please enter the following to continue.</p>
                             <p>If you have previously Login with us, <a href="#">Click Here</a></p>
                             <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

								<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

								<?= $form->field($model, 'password')->passwordInput() ?>

								<?= $form->field($model, 'rememberMe')->checkbox() ?>

								<div style="color:#999;margin:1em 0">
									If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
								</div>

								<div class="form-group">
									<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
								</div>

							<?php ActiveForm::end(); ?>
                            <a href="#">Forgot Password ?</a>
                    </div>
                    <div class="col-md-6 login-right">
                            <h3>New Registration</h3>
                            <div class="strip"></div>
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <a href="register.html" class="button">Create An Account</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

