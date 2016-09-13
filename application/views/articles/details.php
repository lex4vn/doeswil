<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
    <div class="container padding">
        <img src="<?php echo base_url(); ?>assets/designs/images/wilmar.jpg" width="100%">
    </div>
</div>
<!-- Slider-->
<!-- Middle Content-->
<div class="container-fluid content-bg">
    <?php if (isset($news) && count($news) > 0) {?>
    <?php $new = $news[0]; ?>
    <div class="spacer"></div>
    <div class="container padding">
        <div class="col-md-8 col-xs-4">
            <div class="bradcome-menu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
                    <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
                    <li><a href="<?php echo base_url(); ?>articles"><?php echo lang('menu_news'); ?></a></li>
                    <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
                    <li><a href="#"><?php echo $new->title; ?></a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="container inner-content padding">
        <div class="col-md-8 col-xs-12">

                <h1 class="inner-hed">
                    <?php echo $new->title; ?>
                </h1>

            <p>

                <em><?php echo $new->pubdate; ?></em>

            </p>
                <p>

                    <?php echo $new->body; ?>

                </p>

        </div>
        <?php echo $this->load->view('general/quick_links');?>
    </div>
    <div class="spacer"></div>
    <?php } else echo "Coming Soon."; ?>
</div>
</div>
<!-- Middle Content-->

