<?php
function time_ago($datetime): string
{
    if (is_numeric($datetime)) {
        $timestamp = $datetime;
    } else {
        $timestamp = strtotime($datetime);
    }
    $diff = time() - $timestamp;

    $min = 60;
    $hour = 60 * 60;
    $day = 60 * 60 * 24;
    $month = $day * 30;

    if ($diff < 60) //Under a min
    {
        $timeago = $diff . " second" . ($diff > 1 ? "s" : "");
    } elseif ($diff < $hour) //Under an hour
    {
        $timeago = round($diff / $min) . " minute". (round($diff / $min) > 1 ? "s" : "");
    } elseif ($diff < $day) //Under a day
    {
        $timeago = round($diff / $hour) . " hour". (round($diff / $hour) > 1 ? "s" : "");
    } elseif ($diff < $month) //Under a day
    {
        $timeago = round($diff / $day) . " day". (round($diff / $day) > 1 ? "s" : "");
    } else {
        $timeago = round($diff / $month) . " month". (round($diff / $month) > 1 ? "s" : "");
    }

    return $timeago;

}

require "src/public/page/status/Performance.php";
$services = [];

{
    $performance = Performance::OPERATIONAL;
    try {
        $pdo = \MysqlCredentials\MysqlCredentials::getPDO();
        if ($pdo->errorCode() !== null) $performance = Performance::PARTIAL_OUTAGE;
    } catch (Exception) {
        $performance = Performance::MAJOR_OUTAGE;
    }
    $services[] = ["Database connection", $performance, "Database connection through PDO"];
}

{
    $performance = Performance::OPERATIONAL;
    try {
        \Propel\Runtime\Propel::getConnection();
    } catch (Exception) {
        $performance = Performance::MAJOR_OUTAGE;
    }
    $services[] = ["Propel", $performance];
}

{
    $performance = Performance::OPERATIONAL;
    //save previous user id to auth after test
    try {
        $logged_user_id = \inc\artemy\v1\auth\Auth::getUser()->getUserId();
    } catch (Exception) {
    }
    try {
        \inc\artemy\v1\auth\Auth::getUser()->admin()->logInAsUserByEmail("me@artemy.net");
    } catch (Exception) {
        $performance = Performance::MAJOR_OUTAGE;
    }


    try {
        if (isset($logged_user_id)) {
            \inc\artemy\v1\auth\Auth::getUser()->admin()->logInAsUserById($logged_user_id);
        }
    } catch (Exception) {
    }

    $services[] = ["Authentication", $performance];
}

{
    $performance = Performance::OPERATIONAL;
    $host = gethostname();
    $ip = gethostbyname($host);
    $con = ftp_connect($ip, 21, 5);
    if ($con !== false) {
        ftp_login($con, "ftp_user", "vV0bL0cT0k");
        if (!is_int(array_search("branches", ftp_nlist($con, ".")))) $performance = Performance::PARTIAL_OUTAGE;
        ftp_close($con);
    } else {
        $performance = Performance::MAJOR_OUTAGE;
    }

    $services[] = ["FTP connection", $performance];
}

{
    $performance = Performance::OPERATIONAL;

    $ch = curl_init("netflix.com");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 403) $performance = Performance::MAJOR_OUTAGE;

    $services[] = ["Russian propaganda", $performance];
}

{
    $performance = Performance::OPERATIONAL;
    $db_unix_backup = filemtime("mysql_backup.sql");
    var_dump((($db_unix_backup / 60) / 60));
    if ((($db_unix_backup / 60) / 60) > 10) {
        $performance = Performance::DEGRADED_PERFORMANCE;
    }

    if ((($db_unix_backup / 60) / 60) > 11) {
        $performance = Performance::MAJOR_OUTAGE;
    }

    $info = "Last Database backup was " . time_ago($db_unix_backup) . " ago.";
    $services[] = ["Database backup", $performance, $info];
}
?>
    <html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- force IE browsers in compatibility mode to use their most aggressive rendering engine -->

        <meta charset="utf-8">
        <title>Artemy.net Status</title>
        <meta name="description"
              content="Welcome to Artemy's home for real-time data on system performance.">

        <!-- Mobile viewport optimization h5bp.com/ad -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

        <!-- Time this page was rendered - http://purl.org/dc/terms/issued -->
        <meta name="issued" content="1661937307">

        <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
        <meta http-equiv="cleartype" content="on">

        <!-- Le fonts -->
        <style>
            @font-face {
                font-family: 'proxima-nova';
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-f0b2f7c12b6b87c65c02d3c1738047ea67a7607fd767056d8a2964cc6a2393f7.eot?host=status.ucdavis.edu');
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-f0b2f7c12b6b87c65c02d3c1738047ea67a7607fd767056d8a2964cc6a2393f7.eot?host=status.ucdavis.edu#iefix') format('embedded-opentype'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-e642ffe82005c6208632538a557e7f5dccb835c0303b06f17f55ccf567907241.woff?host=status.ucdavis.edu') format('woff'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaLight-0f094da9b301d03292f97db5544142a16f9f2ddf50af91d44753d9310c194c5f.ttf?host=status.ucdavis.edu') format('truetype');
                font-weight: 300;
                font-style: normal;
            }

            @font-face {
                font-family: 'proxima-nova';
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-366d17769d864aa72f27defaddf591e460a1de4984bb24dacea57a9fc1d14878.eot?host=status.ucdavis.edu');
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-366d17769d864aa72f27defaddf591e460a1de4984bb24dacea57a9fc1d14878.eot?host=status.ucdavis.edu#iefix') format('embedded-opentype'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-2ee4c449a9ed716f1d88207bd1094e21b69e2818b5cd36b28ad809dc1924ec54.woff?host=status.ucdavis.edu') format('woff'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegular-a40a469edbd27b65b845b8000d47445a17def8ba677f4eb836ad1808f7495173.ttf?host=status.ucdavis.edu') format('truetype');
                font-weight: 400;
                font-style: normal;
            }

            @font-face {
                font-family: 'proxima-nova';
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-0bf83a850b45e4ccda15bd04691e3c47ae84fec3588363b53618bd275a98cbb7.eot?host=status.ucdavis.edu');
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-0bf83a850b45e4ccda15bd04691e3c47ae84fec3588363b53618bd275a98cbb7.eot?host=status.ucdavis.edu#iefix') format('embedded-opentype'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-0c394ec7a111aa7928ea470ec0a67c44ebdaa0f93d1c3341abb69656cc26cbdd.woff?host=status.ucdavis.edu') format('woff'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaRegularIt-9e43859f8015a4d47d9eaf7bafe8d1e26e3298795ce1f4cdb0be0479b8a4605e.ttf?host=status.ucdavis.edu') format('truetype');
                font-weight: 400;
                font-style: italic;
            }

            @font-face {
                font-family: 'proxima-nova';
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-09566917307251d22021a3f91fc646f3e45f8d095209bcd2cded8a1979f06e54.eot?host=status.ucdavis.edu');
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-09566917307251d22021a3f91fc646f3e45f8d095209bcd2cded8a1979f06e54.eot?host=status.ucdavis.edu#iefix') format('embedded-opentype'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-86724fb2152613d735ba47c3f47a9ad2424b898bea4bece213dacee40344f966.woff?host=status.ucdavis.edu') format('woff'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaSemibold-cf3e4eb7fbdf6fb83e526cc2a0141e55b01097e6e1abfd4cbdc3eda75d183f74.ttf?host=status.ucdavis.edu') format('truetype');
                font-weight: 500;
                font-style: normal;
            }

            @font-face {
                font-family: 'proxima-nova';
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-622ea489d20e12e691663f83217105e957e2d3d09703707d40155a29c06cc9d9.eot?host=status.ucdavis.edu');
                src: url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-622ea489d20e12e691663f83217105e957e2d3d09703707d40155a29c06cc9d9.eot?host=status.ucdavis.edu#iefix') format('embedded-opentype'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-c8dc577ff7f76d2fc199843e38c04bb2e9fd15889421358d966a9f846c2ed1cd.woff?host=status.ucdavis.edu') format('woff'),
                url('https://dka575ofm4ao0.cloudfront.net/assets/ProximaNovaBold-27177fe9242acbe089276ee587feef781446667ffe9b6fdc5b7fe21ad73e12f3.ttf?host=status.ucdavis.edu') format('truetype');
                font-weight: 700;
                font-style: normal;
            }
        </style>


        <!-- Le styles -->
        <link rel="stylesheet" media="all"
              href="https://dka575ofm4ao0.cloudfront.net/assets/status/status_manifest-ed1edbdd1224b3057aa63da9242f87c4a74f19b8bcbfd4d080c4f72f42f041d9.css">


        <script>
            window.pageColorData = {
                "blue": "#3498DB",
                "border": "#E0E0E0",
                "body_background": "#ffffff",
                "font": "#333333",
                "graph": "#3498db",
                "green": "#2fcc66",
                "light_font": "#7F93AE",
                "link": "#daaa00",
                "orange": "#e67e22",
                "red": "#e74c3c",
                "yellow": "#f1c40f",
                "no_data": "#b3bac5"
            };
        </script>
        <style>
            /* BODY BACKGROUND */ /* BODY BACKGROUND */ /* BODY BACKGROUND */ /* BODY BACKGROUND */ /* BODY BACKGROUND */
            body,
            .layout-content.status.status-api .section .example-container .example-opener .color-secondary,
            .grouped-items-selector,
            .layout-content.status.status-full-history .history-nav a.current,
            div[id^="subscribe-modal"] .modal-footer,
            div[id^="subscribe-modal"],
            #uptime-tooltip .tooltip-box {
                background-color: #ffffff;
            }

            #uptime-tooltip .pointer-container .pointer-smaller {
                border-bottom-color: #ffffff;
            }


            /* PRIMARY FONT COLOR */ /* PRIMARY FONT COLOR */ /* PRIMARY FONT COLOR */ /* PRIMARY FONT COLOR */
            body.status,
            .color-primary,
            .color-primary:hover,
            .layout-content.status-index .status-day .update-title.impact-none a,
            .layout-content.status-index .status-day .update-title.impact-none a:hover,
            .layout-content.status-index .timeframes-container .timeframe.active,
            .layout-content.status-full-history .month .incident-container .impact-none,
            .layout-content.status.status-index .incidents-list .incident-title.impact-none a,
            .incident-history .impact-none,
            .layout-content.status .grouped-items-selector.inline .grouped-item.active,
            .layout-content.status.status-full-history .history-nav a.current,
            .layout-content.status.status-full-history .history-nav a:not(.current):hover,
            div[id^="subscribe-modal"] .modal-header .close,
            .grouped-item-label,
            #uptime-tooltip .tooltip-box .tooltip-content .related-events .related-event a.related-event-link {
                color: #333333;
            }

            .layout-content.status.status-index .components-statuses .component-container .name {
                color: #333333;
                color: rgba(51, 51, 51, .8);
            }


            /* SECONDARY FONT COLOR */ /* SECONDARY FONT COLOR */ /* SECONDARY FONT COLOR */ /* SECONDARY FONT COLOR */
            small,
            .layout-content.status .table-row .date,
            .color-secondary,
            .layout-content.status .grouped-items-selector.inline .grouped-item,
            .layout-content.status.status-full-history .history-footer .pagination a.disabled,
            .layout-content.status.status-full-history .history-nav a,
            #uptime-tooltip .tooltip-box .tooltip-content .related-events #related-event-header {
                color: #7F93AE;
            }


            /* BORDER COLOR */ /* BORDER COLOR */ /* BORDER COLOR */ /* BORDER COLOR */ /* BORDER COLOR */ /* BORDER COLOR */
            body.status .layout-content.status .border-color,
            hr,
            .tooltip-base,
            .markdown-display table,
            div[id^="subscribe-modal"],
            #uptime-tooltip .tooltip-box {
                border-color: #E0E0E0;
            }

            div[id^="subscribe-modal"] .modal-footer,
            .markdown-display table td {
                border-top-color: #E0E0E0;
            }

            .markdown-display table td + td, .markdown-display table th + th {
                border-left-color: #E0E0E0;
            }

            div[id^="subscribe-modal"] .modal-header,
            #uptime-tooltip .pointer-container .pointer-larger {
                border-bottom-color: #E0E0E0;
            }

            #uptime-tooltip .tooltip-box .outage-field {
                /*
                  Generate the background-color for the outage-field from the css_body_background_color and css_border_color.

                  For the default background (#ffffff) and default css_border_color (#e0e0e0), use the luminosity of the default background with a magic number to arrive at
                  the original outage-field background color (#f4f5f7). I used the formula Target Color = Color * alpha + Background * (1 - alpha) to find the magic number of ~0.08.

                  For darker css_body_background_color, luminosity values are lower so alpha trends toward becoming transparent (thus outage-field background becomes same as css_body_background_color).
                */
                background-color: rgba(224, 224, 224, 0.31);

                /*
                  outage-field border-color alpha is inverse to the luminosity of css_body_background_color.
                  That is to say, with a default white background this border is transparent, but on a black background, it's opaque css_border_color.
                */
                border-color: rgba(224, 224, 224, 0.0);
            }


            /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */ /* CSS REDS */
            .layout-content.status.status-index .status-day .update-title.impact-critical a,
            .layout-content.status.status-index .status-day .update-title.impact-critical a:hover,
            .layout-content.status.status-index .page-status.status-critical,
            .layout-content.status.status-index .unresolved-incident.impact-critical .incident-title,
            .flat-button.background-red {
                background-color: #e74c3c;
            }

            .layout-content.status-index .components-statuses .component-container.status-red:after,
            .layout-content.status-full-history .month .incident-container .impact-critical,
            .layout-content.status-incident .incident-name.impact-critical,
            .layout-content.status.status-index .incidents-list .incident-title.impact-critical a,
            .status-red .icon-indicator,
            .incident-history .impact-critical,
            .components-container .component-inner-container.status-red .component-status,
            .components-container .component-inner-container.status-red .icon-indicator {
                color: #e74c3c;
            }

            .layout-content.status.status-index .unresolved-incident.impact-critical .updates {
                border-color: #e74c3c;
            }


            /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */ /* CSS ORANGES */
            .layout-content.status.status-index .status-day .update-title.impact-major a,
            .layout-content.status.status-index .status-day .update-title.impact-major a:hover,
            .layout-content.status.status-index .page-status.status-major,
            .layout-content.status.status-index .unresolved-incident.impact-major .incident-title {
                background-color: #e67e22;
            }

            .layout-content.status-index .components-statuses .component-container.status-orange:after,
            .layout-content.status-full-history .month .incident-container .impact-major,
            .layout-content.status-incident .incident-name.impact-major,
            .layout-content.status.status-index .incidents-list .incident-title.impact-major a,
            .status-orange .icon-indicator,
            .incident-history .impact-major,
            .components-container .component-inner-container.status-orange .component-status,
            .components-container .component-inner-container.status-orange .icon-indicator {
                color: #e67e22;
            }

            .layout-content.status.status-index .unresolved-incident.impact-major .updates {
                border-color: #e67e22;
            }


            /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */ /* CSS YELLOWS */
            .layout-content.status.status-index .status-day .update-title.impact-minor a,
            .layout-content.status.status-index .status-day .update-title.impact-minor a:hover,
            .layout-content.status.status-index .page-status.status-minor,
            .layout-content.status.status-index .unresolved-incident.impact-minor .incident-title,
            .layout-content.status.status-index .scheduled-incidents-container .tab {
                background-color: #f1c40f;
            }

            .layout-content.status-index .components-statuses .component-container.status-yellow:after,
            .layout-content.status-full-history .month .incident-container .impact-minor,
            .layout-content.status-incident .incident-name.impact-minor,
            .layout-content.status.status-index .incidents-list .incident-title.impact-minor a,
            .status-yellow .icon-indicator,
            .incident-history .impact-minor,
            .components-container .component-inner-container.status-yellow .component-status,
            .components-container .component-inner-container.status-yellow .icon-indicator,
            .layout-content.status.manage-subscriptions .confirmation-infobox .fa {
                color: #f1c40f;
            }

            .layout-content.status.status-index .unresolved-incident.impact-minor .updates,
            .layout-content.status.status-index .scheduled-incidents-container {
                border-color: #f1c40f;
            }


            /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */ /* CSS BLUES */
            .layout-content.status.status-index .status-day .update-title.impact-maintenance a,
            .layout-content.status.status-index .status-day .update-title.impact-maintenance a:hover,
            .layout-content.status.status-index .page-status.status-maintenance,
            .layout-content.status.status-index .unresolved-incident.impact-maintenance .incident-title,
            .layout-content.status.status-index .scheduled-incidents-container .tab {
                background-color: #3498DB;
            }

            .layout-content.status-index .components-statuses .component-container.status-blue:after,
            .layout-content.status-full-history .month .incident-container .impact-maintenance,
            .layout-content.status-incident .incident-name.impact-maintenance,
            .layout-content.status.status-index .incidents-list .incident-title.impact-maintenance a,
            .status-blue .icon-indicator,
            .incident-history .impact-maintenance,
            .components-container .component-inner-container.status-blue .component-status,
            .components-container .component-inner-container.status-blue .icon-indicator {
                color: #3498DB;
            }

            .layout-content.status.status-index .unresolved-incident.impact-maintenance .updates,
            .layout-content.status.status-index .scheduled-incidents-container {
                border-color: #3498DB;
            }


            /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */ /* CSS GREENS */
            .layout-content.status.status-index .page-status.status-none {
                background-color: #2fcc66;
            }

            .layout-content.status-index .components-statuses .component-container.status-green:after,
            .status-green .icon-indicator,
            .components-container .component-inner-container.status-green .component-status,
            .components-container .component-inner-container.status-green .icon-indicator {
                color: #2fcc66;
            }


            /* CSS LINK COLOR */ /* CSS LINK COLOR */ /* CSS LINK COLOR */ /* CSS LINK COLOR */ /* CSS LINK COLOR */ /* CSS LINK COLOR */
            a,
            a:hover,
            .layout-content.status-index .page-footer span a:hover,
            .layout-content.status-index .timeframes-container .timeframe:not(.active):hover,
            .layout-content.status-incident .subheader a:hover {
                color: #daaa00;
            }

            .flat-button,
            .masthead .updates-dropdown-container .show-updates-dropdown,
            .layout-content.status-full-history .show-filter.open {
                background-color: #daaa00;
            }


            /* CUSTOM COLOR OVERRIDES FOR UPTIME SHOWCASE */
            .components-section .components-uptime-link {
                color: #7f93ae;
            }

            .layout-content.status .shared-partial.uptime-90-days-wrapper .legend .legend-item {
                color: #7f93ae;
                opacity: 0.8;
            }

            .layout-content.status .shared-partial.uptime-90-days-wrapper .legend .legend-item.light {
                color: #7f93ae;
                opacity: 0.5;
            }

            .layout-content.status .shared-partial.uptime-90-days-wrapper .legend .spacer {
                background: #7f93ae;
                opacity: 0.3;
            }
        </style>
    </head>
    <body class="status index status-none" data-breakpoint-reached="true">
    <div class="layout-content status status-index premium">
        <div class="custom-header-container">


        </div>
        <div class="container">
            <?php
            $not_working_services_count = 0;
            $performance_cases = Performance::cases();
            $worst_performance = Performance::OPERATIONAL;
            foreach ($services as $service) {
                if (array_search($service[1], $performance_cases, true) > array_search($worst_performance,
                                                                                       $performance_cases, true)) {
                    $worst_performance = $service[1];
                }

                if ($service[1] !== Performance::OPERATIONAL) $not_working_services_count++;
            }
            ?>
            <div class="page-status status-blue <?php
            switch ($worst_performance) {
                case Performance::OPERATIONAL:
                    echo "status-none";
                    break;
                case Performance::DEGRADED_PERFORMANCE:
                    echo "status-minor";
                    break;
                case Performance::MAINTENANCE:
                case Performance::PARTIAL_OUTAGE:
                    echo "status-major";
                    break;
                case Performance::MAJOR_OUTAGE:
                    echo "status-critical";
                    break;
            }
            ?>">
          <span class="status font-large">
              <?php
              if ($not_working_services_count === 0) echo "All Systems Operational";
              elseif ($not_working_services_count === 1) echo "1 System Not Operational";
              else echo "$not_working_services_count Systems Not Operational";
              ?>
          </span>
                <span class="last-updated-stamp  font-small"></span>
            </div>
            <div class="components-section font-regular">


                <!--            SERVICES-->
                <div class="components-container three-columns">
                    <?php
                    foreach ($services as $service) {
                        $info = !array_key_exists(2, $service) ? "" : $service[2];
                        insertServiceBlock($service[0], $service[1], $info);
                    }
                    ?>
                </div>


                <!--            EXPLAINING-->
                <div class="component-statuses-legend font-small">
                    <div class="legend-item status-green">
                        <span class="icon-indicator fa fa-check"></span>
                        Operational
                    </div>
                    <div class="legend-item status-yellow">
                        <span class="icon-indicator fa fa-minus-square"></span>
                        Degraded Performance
                    </div>
                    <div class="legend-item status-orange">
                        <span class="icon-indicator fa fa-exclamation-triangle"></span>
                        Partial Outage
                    </div>
                    <div class="breaker"></div>
                    <div class="legend-item status-red">
                        <span class="icon-indicator fa fa-times"></span>
                        Major Outage
                    </div>
                    <div class="legend-item status-blue">
                        <span class="icon-indicator fa fa-wrench"></span>
                        Maintenance
                    </div>
                </div>

            </div>
        </div>
    </div>
    </body>
    </html>

<?php
function insertServiceBlock($name, Performance $performance, $info = ""): void
{
    ?>
    <div class="component-container border-color">
        <!--        status-green-->
        <div data-component-id="t6j7mxgpmd8p" class="component-inner-container <?php
        switch ($performance) {
            case Performance::OPERATIONAL:
                echo "status-green";
                break;
            case Performance::DEGRADED_PERFORMANCE:
                echo "status-yellow";
                break;

            case Performance::PARTIAL_OUTAGE:
                echo "status-orange";
                break;

            case Performance::MAJOR_OUTAGE:
                echo "status-red";
                break;

            case Performance::MAINTENANCE:
                echo "status-blue";
                break;

        }
        ?>"
             data-component-status="operational" data-js-hook="">
            <span class="name"><?= $name ?></span>
            <span style="opacity: <?= !empty($info) ? 1 : 0 ?>" title="<?= $info ?>" class="tooltip-base tool
            tooltipstered">?</span>
            <span class="component-status " title=""><?= $performance->value ?></span>
            <!--            fa-check-->
            <span class="tool icon-indicator fa <?php
            switch ($performance) {
                case Performance::OPERATIONAL:
                    echo "fa-check";
                    break;
                case Performance::DEGRADED_PERFORMANCE:
                    echo "fa-minus-square";
                    break;

                case Performance::PARTIAL_OUTAGE:
                    echo "fa-exclamation-triangle";
                    break;

                case Performance::MAJOR_OUTAGE:
                    echo "fa-times";
                    break;

                case Performance::MAINTENANCE:
                    echo "fa-wrench";
                    break;

            }
            ?> tooltipstered"></span>
        </div>
    </div>
    <?php
}