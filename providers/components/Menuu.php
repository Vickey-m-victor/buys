<?php

namespace helpers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Menu as BaseMenu;

class Menuu extends BaseMenu
{
    public $itemOptions = ['class' => 'nav-item'];
    public $linkTemplate = '<a class="nav-link {active}" href="{url}">{label}</a>';
    public $labelTemplate = '{label}';
    public $submenuTemplate = "\n<ul class=\"dropdown-menu\">\n{items}\n</ul>\n";
    public $encodeLabels = false;
    public $activeCssClass = 'active';
    public $activateItems = true;
    public $activateParents = true;
    public $hideEmptyItems = true;
    public $options = ['class' => 'navbar-nav ms-auto py-0']; // Adjust for navbar alignment

    public static function load($items = [], $subs = [])
    {
        foreach (require dirname(dirname(__DIR__)) . '/config/menuu.php' as $menuKey => $item) {
            $label = $item['title'];
            $icon = '<i class="fa fa-' . $item['icon'] . ' me-2"></i>'; // Optional icons
            $linkLabel = $icon . '<span>' . $label . '</span>';

            if (isset($item['url'])) {
                $items[] = ['label' => $linkLabel, 'url' => [$item['url']], 'visible' => 1];
            } else {
                foreach ($item['submenus'] as $key => $miniItem) {
                    $url = isset($miniItem['param']) 
                        ? [$miniItem['url'], key($miniItem['param']) => $miniItem['param'][key($miniItem['param'])]] 
                        : [$miniItem['url']];
                    $subs[$menuKey][] = ['label' => $miniItem['title'], 'url' => $url, 'visible' => 1];
                }

                if (!empty($subs[$menuKey])) {
                    $items[] = [
                        'label' => $linkLabel,
                        'url' => '#',
                        'template' => '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{label}</a>',
                        'items' => $subs[$menuKey],
                        'options' => ['class' => 'nav-item dropdown'],
                        'visible' => 1,
                    ];
                }
            }
        }

        return self::widget(['items' => $items]);
    }

    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
                '{active}' => $item['active'] ? $this->activeCssClass : '',
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = (empty($item['items'])) ? $this->activeCssClass : 'open';
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }
}
