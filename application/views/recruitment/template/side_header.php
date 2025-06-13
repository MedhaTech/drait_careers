<?php if ($details->post_of == "Teaching") { ?>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <?php echo anchor('recruitment/profile#personal', 'Personal Details'); ?>
        </li>

        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 1)
                echo anchor('recruitment/profile#language', 'Languages Known');
            else
                echo anchor('recruitment/profile#language', 'Languages Known', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 2)
                echo anchor('recruitment/profile#education', 'Educational Qualification');
            else
                echo anchor('recruitment/profile#education', 'Educational Qualification', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 3)
                echo anchor('recruitment/profile#research', 'Research Experience');
            else
                echo anchor('recruitment/profile#research', 'Research Experience', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">

            <?php

            if ($details->menu_flag >= 4)
                echo anchor('recruitment/profile#publications', 'Publications');
            else
                echo anchor('recruitment/profile#publications', 'Publications', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 5)
                echo anchor('recruitment/profile#teaching', 'Teaching Experience');
            else
                echo anchor('recruitment/profile#teaching', 'Teaching Experience', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 6)
                echo anchor('recruitment/profile#industrial', 'Industrial Experience');
            else
                echo anchor('recruitment/profile#industrial', 'Industrial Experience', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 7)
                echo anchor('recruitment/profile#affiliations', 'Affiliations');
            else
                echo anchor('recruitment/profile#affiliations', 'Affiliations', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">

            <?php

            if ($details->menu_flag >= 7)
                echo anchor('recruitment/profile#patents', 'Patents');
            else
                echo anchor('recruitment/profile#patents', 'Patents', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 7)
                echo anchor('recruitment/profile#Projects', 'Projects');
            else
                echo anchor('recruitment/profile#Projects', 'Projects', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 7)
                echo anchor('recruitment/profile#Consultancy', 'Consultancy');
            else
                echo anchor('recruitment/profile#Consultancy', 'Consultancy', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 7)
                echo anchor('recruitment/profile#Seminars', 'Seminars');
            else
                echo anchor('recruitment/profile#Seminars', 'Seminars', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 7)
                echo anchor('recruitment/profile#Membership', 'Professional Membership');
            else
                echo anchor('recruitment/profile#Membership', 'Professional Membership', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php

            echo anchor('recruitment/profile#references', 'References');

            ?>
        </li>
        <li class="list-group-item">
            <?php

            echo anchor('recruitment/profile#documents', 'Documents');

            ?>
        </li>
        <li class="list-group-item">
            <?php echo anchor('recruitment/changePassword', 'Change Password'); ?>
        </li>
        <li class="list-group-item">
            <?php echo anchor('recruitment/logout', 'Logout'); ?>
        </li>
    </ul>

<?php } else { ?>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <?php echo anchor('recruitment/profile#personal', 'Personal Details'); ?>
        </li>

        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 1)
                echo anchor('recruitment/profile#language', 'Languages Known');
            else
                echo anchor('recruitment/profile#language', 'Languages Known', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 2)
                echo anchor('recruitment/profile#education', 'Educational Qualification');
            else
                echo anchor('recruitment/profile#education', 'Educational Qualification', 'class="btn disabled"');
            ?>
        </li>

        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 2)
                echo anchor('recruitment/profile#industrial', 'Experience');
            else
                echo anchor('recruitment/profile#industrial', 'Experience', 'class="btn disabled"');
            ?>
        </li>
         <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 2)
                echo anchor('recruitment/profile#Seminars', 'Training - workshop/Seminar');
            else
                echo anchor('recruitment/profile#Seminars', 'Training - workshop/Seminar', 'class="btn disabled"');
            ?>
        </li>
         <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 2)
                echo anchor('recruitment/profile#Skills', 'Other Skills');
            else
                echo anchor('recruitment/profile#Skills', 'Other Skills', 'class="btn disabled"');
            ?>
        </li>
        <li class="list-group-item">
            <?php
            if ($details->menu_flag >= 2)
                echo anchor('recruitment/profile#Awards', 'Awards');
            else
                echo anchor('recruitment/profile#Awards', 'Awards', 'class="btn disabled"');
            ?>
        </li>
       

        <li class="list-group-item">
            <?php

            echo anchor('recruitment/profile#references', 'References');

            ?>
        </li>
        <li class="list-group-item">
            <?php

            echo anchor('recruitment/profile#documents', 'Documents');

            ?>
        </li>
        <li class="list-group-item">
            <?php echo anchor('recruitment/changePassword', 'Change Password'); ?>
        </li>
        <li class="list-group-item">
            <?php echo anchor('recruitment/logout', 'Logout'); ?>
        </li>
    </ul>
<?php } ?>