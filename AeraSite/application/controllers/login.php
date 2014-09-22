<!-- Main -->
<div id="main">
    <div id="main-bot">
        <div class="cl">&nbsp;</div>
        <!-- Content -->
        <div id="content">

            <div class="block">
                <div class="block-bot">
                    <div class="head">
                        <div class="head-cnt">

                            <h3>Main <?php echo $title; ?></h3>

                            <div class="cl">&nbsp;</div>
                        </div>
                    </div>
                    <div class="row-articles articles">
                        <div class="cl">&nbsp;</div>

                        <div class="article last-article">
                            <?php



                            echo form_open('login/login_in');
                            ?>

                            <p style="padding:5px 5px 5px 5px; background:#1B1B1B"><strong>Instruction :</strong> Sign
                                In into your character management.
                            </p>

                            <p>&nbsp;  </p>

                            <div style="padding-top:5px; padding-bottom:5px">
                                <label for="name">Username : </label> <input
                                    id="name" type="text" name="username" placeholder="Username">

                            </div>

                            <div style="padding-top:5px; padding-bottom:5px">
                                <label for="password">Password : </label> <input
                                    id="password" type="password" placeholder="Password" name="pass">

                            </div>


                            <div style="padding-top:5px; padding-bottom:5px">
                                <button type="submit" name="submit" value="Submit">SIGN IN
                                </button>
                            </div>


                            <p>&nbsp;  </p>

                            <p><?php if (isset($status))
                                {
                                    echo  $status;
                                }?></p>


                            <?php echo form_close(); ?>
                        </div>
                        <div class="cl">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>

