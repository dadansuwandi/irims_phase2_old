<!-- Source from https://codepen.io/prideaux/pen/VwYazbM -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<style type="text/css">
    /* MDC stuff */
    .mdc-bottom-navigation {
        height: 56px;
        background-color: var(--mdc-theme-background, #fff);
        width: 100%;
        box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        z-index: 8;
    }
    .mdc-bottom-navigation__list {
        display: flex;
        justify-content: center;
        height: 100%;
    }
    .mdc-bottom-navigation__list-item {
        flex: 1 1 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 0 12px;
        min-width: 60px;
        max-width: 168px;
        box-sizing: border-box;
        color: var(--mdc-theme-text-secondary-on-background, rgba(0, 0, 0, 0.54));
        -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
                user-select: none;
    }
    .mdc-bottom-navigation__list-item__icon {
        padding-top: 8px;
        pointer-events: none;
        transition-property: padding-top, color;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 100ms;
    }
    .mdc-bottom-navigation__list-item__icon path {
        fill: var(--mdc-theme-text-secondary-on-background, rgba(0, 0, 0, 0.54));
    }
    .mdc-bottom-navigation__list-item__text {
        margin-top: auto;
        padding-bottom: 10px;
        font-size: 0.75rem;
        pointer-events: none;
        transition-property: font-size, color;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 100ms;
    }
    .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__icon {
        padding-top: 6px;
    }
    .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__text {
        font-size: 0.875rem;
    }
    .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__icon, .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__text {
        color: var(--mdc-theme-primary, #6200ee);
    }
    .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__icon path, .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__text path {
        fill: var(--mdc-theme-primary, #6200ee);
    }
    .mdc-bottom-navigation--shifting .mdc-bottom-navigation__list-item {
        min-width: 56px;
        max-width: 96px;
        transition-property: min-width, max-width;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 100ms;
    }
    .mdc-bottom-navigation--shifting .mdc-bottom-navigation__list-item .mdc-bottom-navigation__list-item__icon {
        padding-top: 16px;
        transition-property: padding-top;
    }
    .mdc-bottom-navigation--shifting .mdc-bottom-navigation__list-item .mdc-bottom-navigation__list-item__text {
        position: absolute;
        line-height: 10px;
        bottom: 0;
        opacity: 0;
        transition-property: opacity, font-size;
    }
    .mdc-bottom-navigation--shifting .mdc-bottom-navigation__list-item--activated {
        min-width: 96px;
        max-width: 168px;
    }
    .mdc-bottom-navigation--shifting .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__icon {
        padding-top: 8px;
        transition-property: padding-top;
    }
    .mdc-bottom-navigation--shifting .mdc-bottom-navigation__list-item--activated .mdc-bottom-navigation__list-item__text {
        white-space: nowrap;
        opacity: 1;
    }
</style>

<!-- BEGIN BOTTOM NAVBAR -->
<div class="page-footer">
    <div class="page-footer-inner md-shadow-z-1-i navbar navbar-fixed-bottom">
        <div class="mdc-bottom-navigation">
            <nav class="mdc-bottom-navigation__list">
                <a href="<?php echo base_url('index.php/welcome/index_corporate') ?>">
                    <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary"
                        data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                        <span class="material-icons mdc-bottom-navigation__list-item__icon">home</span>
                        <span class="mdc-bottom-navigation__list-item__text">Home</span>
                    </span>
                </a>

                <a href="<?php echo base_url('index.php/risk/risk_evaluation/index') ?>">
                    <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary"
                        data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                        <span class="material-icons mdc-bottom-navigation__list-item__icon">assessment</span>
                        <span class="mdc-bottom-navigation__list-item__text">Process</span>
                    </span>
                </a>

                <a href="<?php echo base_url('index.php/report/risk_map/index_mitigated') ?>">
                    <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary"
                        data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                        <span class="material-icons mdc-bottom-navigation__list-item__icon">assignment_turned_in</span>
                        <span class="mdc-bottom-navigation__list-item__text">Mitigated</span>
                    </span>
                </a>

                <a href="<?php echo base_url('index.php/report/risk_assessment_report/register_card') ?>">
                    <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary"
                        data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                        <span class="material-icons mdc-bottom-navigation__list-item__icon">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path
                                    d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z">
                                </path>
                            </svg>
                        </span>
                        <span class="mdc-bottom-navigation__list-item__text">Report</span>
                    </span>
                </a>
                
                <!-- <a href="<?php //echo base_url('index.php/report/risk_assessment_report/register_card') ?>">
                    <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary"
                        data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                        <span class="material-icons mdc-bottom-navigation__list-item__icon">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path
                                    d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z">
                                </path>
                            </svg>
                        </span>
                        <span class="mdc-bottom-navigation__list-item__text">Report</span>
                    </span>
                </a> -->

                <a href="<?php echo base_url('index.php/auth/logout') ?>">
                    <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary"
                        data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
                        <span class="material-icons mdc-bottom-navigation__list-item__icon">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path
                                    d="M16 17v-3H9v-4h7V7l5 5l-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9z">
                                </path>
                            </svg>
                        </span>
                        <span class="mdc-bottom-navigation__list-item__text">Logout</span>
                    </span>
                </a>
            </nav>
        </div>
    </div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END BOTTOM NAVBAR -->

<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.js"></script>
<script>
    mdc.autoInit()
    var lists = document.querySelectorAll('.mdc-bottom-navigation__list')
    var activatedClass = 'mdc-bottom-navigation__list-item--activated'
    for (var i = 0, list; list = lists[i]; i++) {
        list.addEventListener('click', function(event) {
            var el = event.target
            while (!el.classList.contains('mdc-bottom-navigation__list-item') && el) {
                el = el.parentNode
            }
            if (el) {
                var selectRegex = /.*(card-\d).*/;
                var activatedItem = document.querySelector('.' + event.target.parentElement.parentElement.parentElement.className.replace(selectRegex, '$1') + ' .' + activatedClass)
                if (activatedItem) {
                    activatedItem.classList.remove(activatedClass)
                }
                event.target.classList.add(activatedClass)
            }
        })
    }
</script>