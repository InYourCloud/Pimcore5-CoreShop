<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2017 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
*/

namespace CoreShop\Component\Index\Getter;

use CoreShop\Component\Index\Model\IndexableInterface;
use CoreShop\Component\Index\Model\IndexColumnInterface;
use Pimcore\Service\Locale;

class LocalizedFieldGetter implements GetterInterface
{
    /**
     * @var Locale
     */
    protected $localeService;

    /**
     * @param Locale $localeService
     */
    public function __construct(Locale $localeService)
    {
        $this->localeService = $localeService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(IndexableInterface $object, IndexColumnInterface $config)
    {
        $language = null;

        if ($this->localeService->getLocale()) {
            $language = $this->localeService->getLocale();
        }

        $getter = 'get'.ucfirst($config->getConfiguration()['key']);

        return $object->$getter($language);
    }
}