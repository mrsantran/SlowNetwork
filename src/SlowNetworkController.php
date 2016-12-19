<?php

namespace SanTran\SlowNetwork;

use Illuminate\Routing\Controller as SlowController;

class SlowNetworkController extends SlowController
{

    public function index()
    {
        $js = "";
        if (config('slownetwork.enable')) {
            $js = 'var html_node = document.getElementsByTagName("html")[0];
var div = document.createElement("div");
div.setAttribute("id", "slow-notice");
div.setAttribute("style", "text-align: center; width: 100%; position: absolute; z-index: 99999; top: 0px;");
var slowLoad = window.setTimeout(function () {
    var div2 = document.createElement("div");
    var ct = document.createElement("center");
    var t1 = document.createTextNode("' . config('slownetwork.text_taking_long_time') . '");
    var br = document.createElement("br");
    var t2 = document.createTextNode("' . config('slownetwork.text_reload_page') . ' ");
    var a = document.createElement("a");
    a.setAttribute("href", document.URL);
    a.innerHTML = "' . config('slownetwork.text_click_here') . '";
    var dismiss = document.createElement("span");
    dismiss.innerHTML = "' . config('slownetwork.text_dismiss') . '";
    dismiss.setAttribute("class", "dismiss");
    dismiss.setAttribute("style", "float: right; margin-right: 3px; cursor: pointer;");
    dismiss.onclick = function () {
        html_node.removeChild(div);
        document.body.style = "margin-bottom: ' . config('slownetwork.margin_bottom') . 'px;";
    };
    document.body.style = "margin-bottom: ' . config('slownetwork.margin_bottom') . 'px;margin-top: ' . config('slownetwork.margin_top') . 'px;";
    var dismiss_container = document.createElement("div");
    dismiss_container.appendChild(dismiss);
    dismiss_container.setAttribute("class", "dismiss-container");
    div2.setAttribute("style", "text-align: center; width: ' . config('slownetwork.width') . 'px; background: ' . config('slownetwork.color') . '; height: ' . config('slownetwork.height') . 'px;");
    div.appendChild(ct);
    ct.appendChild(div2);
    div2.appendChild(t1);
    div2.appendChild(br);
    div2.appendChild(t2);
    div2.appendChild(a);
    div2.appendChild(dismiss_container);
    html_node.appendChild(div);
}, ' . config('slownetwork.timeout') . ');

window.addEventListener("load", function () {
    try {
        document.body.style = "margin-bottom: ' . config('slownetwork.margin_bottom') . 'px;";
        window.clearTimeout(slowLoad);
        html_node.removeChild(div);
    } catch (e) {
    }
});';
        }
        return response($js, 200)->header('Content-Type', 'application/javascript');
    }

}
