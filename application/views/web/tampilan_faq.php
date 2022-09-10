<style>
    /* Style the buttons that are used to open and close the accordion panel */
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: left;
        border: none;
        outline: none;
        transition: 0.4s;
    }

    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    .active,
    .accordion:hover {
        background-color: #f82c2c;
        color: #ffffff;
    }

    .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }

    .accordion:after {
        content: '\02795';
        /* Unicode character for "plus" sign (+) */
        font-size: 13px;
        color: #777;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2796";
        /* Unicode character for "minus" sign (-) */
    }
</style>
<div class="container mb-4">
    <hr>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">FAQ Seeker</h1>
        <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <?php foreach ($faq_seeker as $key) { ?>
        <button class="accordion seeker"><?= $key->faq_question; ?></button>
        <div class="panel">
            <p><?= $key->faq_answer; ?></p>
        </div>
    <?php }; ?>
    <hr>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">FAQ Provider</h1>
        <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <?php foreach ($faq_provider as $key) { ?>
        <button class="accordion provider"><?= $key->faq_question; ?></button>
        <div class="panel">
            <p><?= $key->faq_answer; ?></p>
        </div>
    <?php }; ?>

</div>
<script src="<?php echo base_url() ?>assets/js/vendor/jquery-1.12.4.min.js"></script>

<script>
    var seeker = $(".seeker");
    var x;

    for (x = 0; x < seeker.length; x++) {
        seeker[x].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

    var provider = $(".provider");
    var i;

    for (i = 0; i < provider.length; i++) {
        provider[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>