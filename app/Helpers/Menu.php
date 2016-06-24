<?php
/**
 * Created by PhpStorm.
 * User: Alexa
 * Date: 16/4/27
 * Time: 下午2:43.
 */

namespace App\Helper;

class Menu
{
    public static function make()
    {
        $list = [
            ['cms', 'Dashboard'],
            [
                ['#', '新闻管理'],
                ['cms/post', '查看'],
                ['cms/post/create', '添加'],
            ],
            ['cms/wechat', '用户授权记录'],
            ['cms/infos', '照片查看'],
        ];
        $html = '';
        foreach ($list as $menu) {
            if (is_array($menu[0])) {
                foreach ($menu as $key => $sub) {
                    if ($key == 0) {
                        $html .= '<li><a href="#" class="';
                        //$html .= 'expand active-state';
                        $html .= '"><i class="l-basic-folder"></i> <span class="txt">'.$sub[1].'</span></a>';
                        $html .= '<ul class="sub ">';
                    } else {
                        $html .= '<li><a href="'.url($sub[0]).'" class="';
                        $html .=  \Request::is($sub[0]) ? 'active' : '';
                        $html .=  '"><span class="txt">'.$sub[1].'</span></a></li>';
                    }

                    if ($key == count($menu) - 1) {
                        $html .= '</ul></li>';
                    }
                }
            } else {
                $html .= '<li><a href="'.url($menu[0]).'" class="';
                $html .=  \Request::is($menu[0]) ? 'active' : '';
                $html .= '"><i class="l-basic-laptop"></i><span class="txt">'.$menu[1].'</span></a></li>';
            }
        }

        return $html;
    }
}
