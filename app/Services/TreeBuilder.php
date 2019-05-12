<?php
/**
 * Created by PhpStorm.
 * User: sithira
 * Date: 2019-01-15
 * Time: 07:33
 */

namespace App\Services;


use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


class TreeBuilder
{
    /**
     * Build tree for a single user.
     *
     * @param Collection $users
     * @return string
     */
    public static function render(Collection $users): string
    {
        $tree = '<ul id="user-tree" style="font-size: 20px">';

        // we could have multiple users in a single line
        foreach ($users as $user) {

            /**
             * @var $user User
             */

            $tree .= '<li class="tree-view closed"><a href="#">' . strtoupper($user->email) . "  (" . $user->name . ') </a>';

            if (count($user->children)) {
                $tree .= self::buildRecursiveTree($user);
            }
        }

        $tree .= '<ul>';

        return $tree;
    }


    /**
     * Recursively build tree for a single user.
     *
     * @param User $user
     * @return string
     */
    private static function buildRecursiveTree(User $user): string
    {
        $html = '<ul>';

        foreach ($user->children as $arr) {
            if (count($arr->children)) {
                $html .= '<li>' . Str::limit($arr->email, 10) . " (" . $arr->name . ")";
                $html .= self::buildRecursiveTree($arr);
            } else {
                $html .= '<li>' . str_limit($arr->email, 10) . " (" . $arr->name . ")";
                $html .= "</li>";
            }

        }

        $html .= "</ul>";

        return $html;
    }
}
