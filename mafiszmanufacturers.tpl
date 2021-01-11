{**
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
*}

<div class="mafisz_manufacturers">
    <p class="h3">Partnerzy</p>
    <div class="container">
        {foreach from=$manufacturers item="manufacturer"}
            <img src="{$manufacturer['image_url']}"/>
        {/foreach}
    </div>
</div>