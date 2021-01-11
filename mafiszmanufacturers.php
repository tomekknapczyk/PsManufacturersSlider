<?php
/**
 * Copyright 2020 Mafisz
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0).
 * It is available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 *
 * @author    Mafisz <mafisz@gmail.com>
 * @copyright Mafisz
 * @license   https://opensource.org/licenses/AFL-3.0  Academic Free License (AFL 3.0)
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class MafiszManufacturers extends Module implements WidgetInterface
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'mafiszmanufacturers';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Mafisz';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Mafisz manufacturers slider');
        $this->description = $this->l('Blok z producentami. Wymaga aktywnego skryptu slick.js');

        $this->confirmUninstall = $this->l('');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:mafiszmanufacturers/mafiszmanufacturers.tpl';
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('header');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function renderWidget($hookName = null, array $configuration = [])
    {
        if (!$this->isCached($this->templateFile, $this->getCacheId('mafiszmanufacturers'))) {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        }

        return $this->fetch($this->templateFile, $this->getCacheId('mafiszmanufacturers'));
    }

    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        $lang = $this->context->language->id;
        $shop = $this->context->shop->id;

        $manufacturers = Manufacturer::getManufacturers();

        foreach ($manufacturers as &$manufacturer) {
            $manufacturer['image_url'] =  $this->context->link->getManufacturerImageLink($manufacturer['id_manufacturer']);
        }

        return [
            'manufacturers' => $manufacturers
        ];
    }
}
