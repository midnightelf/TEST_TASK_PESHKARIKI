<?php


/**
 * enable to display errors
 *
 * @return void
 */
function enable_errors(): void
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


/**
 * Insert the view in `Views/layouts/layout.php`. View name relative to the `VIEWS_DIR` folder
 *
 * @param string $view
 * @param array $data
 * @return bool
 */
function view(string $view, array $data = []): bool
{
    // used in layout.php file
    $view = VIEWS_DIR . $view . '.php';

    extract($data);

    require VIEWS_DIR . 'layouts/layout.php';

    return true;
}

/**
 * Return HTML of view. View name relative to the `VIEWS_DIR` folder
 *
 * @param string $view
 * @return string
 */
function html_view(string $view): string
{
    $view = VIEWS_DIR . $view . '.php';

    return file_get_contents($view);
}

/**
 * Return html view content with eval php code. View name relative to the `VIEWS_DIR` folder
 *
 * @param string $view
 * @param array $data
 * @return string
 */
function eval_html_view(string $view, $data = []): string
{
    $view = VIEWS_DIR . $view . '.php';

    extract($data);

    ob_start();
    include_once($view);
    return ob_get_clean();
}

/**
 * Output a error message and terminate the current script
 *
 * @param  string $status
 * @return void
 */
function abort(string $status = "Error"): void
{
    exit('<b>ERROR:</b> ' . $status);
}

/**
 * Checks array elements for isset, if !isset abort(), else return the array of params
 *
 * @param array $param_names
 * @param string $method
 * @return array
 */
function check_request_params_on_required(array $param_names, string $method = 'post'): array
{
    $params = [];
    $method = strtolower($method);

    if ($method === 'post') $method = $_POST;
    else $method = $_GET;

    foreach ($param_names as $param_name) {
        if (empty($method[$param_name]) || ctype_space($method[$param_name]))
            abort("$param_name is required");
        else
            $params[$param_name] = $method[$param_name];
    }

    return $params;
}

/**
 * user redirect on $url
 *
 * @param string $url
 */
function redirect(string $url): void
{
    header("location: $url");
}

/**
 * Return pagination html markup
 *
 * @param int $start
 * @param int $count
 * @param int $total
 * @return string
 */
function pagination_html(int $total, int $start = 0, int $count = 3): string
{
    $uri_path = get_path_uri();

    $a = [];
    $base_href = $uri_path;
    $per_page_href = $uri_path;

    if (isset($_GET['offset'])) {
        $offset = (int) $_GET['offset'];

        $prev_href = $base_href . '?offset=' .
            ($offset == 0 ? $offset : $offset - $count);

        $next_href = $base_href . '?offset=' .
            ($offset + $count > $total ? $offset : $offset + $count);
    } else {
        $prev_href = $base_href . '?offset=' . $start;
        $next_href = $base_href . '?offset=' . $count;
    }

    if (isset($_GET['sort'])) {
        $prev_href .= "&sort=$_GET[sort]";
        $next_href .= "&sort=$_GET[sort]";
        $per_page_href .= "?sort=$_GET[sort]";
    }

    $page_num = 1;
    for ($i = 0; $i <= $total; $i+=$count) {
        if (!isset($_GET['sort'])) $offset = '?offset=';
        else $offset = '&offset=';

        $a[] = '<a href="'.$per_page_href.$offset.$i.'" class="task-pagination__a pagination_hover">'.$page_num.'</a>';
        $page_num++;
    }

    return
        "<div class='task-pagination'>
            <a href='$prev_href' class='task-pagination__a pagination_hover'>prev</a>
            <div class='task-pagination__pages'>".implode('', $a)."</div>
            <a href='$next_href' class='task-pagination__a pagination_hover'>next</a>
        </div>";
}

/**
 * Return the hash of string
 *
 * @param $string
 * @return string
 */
function hash_make($string): string
{
    return hash('md5', $string);
}

/**
 * Check the session login and password values
 *
 * @return bool
 */
function check_auth(): bool
{
    if (!isset($_SESSION['login']) && !isset($_SESSION['password']))
        return false;

    return true;
}

/**
 * Redirect to back route
 *
 * @return void
 */
function back(): void
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

/**
 * Return URI path only
 *
 * @return string
 */
function get_path_uri(): string
{
    return explode('?', $_SERVER['REQUEST_URI'])[0];
}

function flt_input(string $text)
{
    return htmlspecialchars($text);
}