<?php
/**
 * Shopware 4.0
 * Copyright © 2013 shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @package    Shopware_Models
 * @subpackage Payment
 * @copyright  Copyright (c) 2013, shopware AG (http://www.shopware.de)
 * @version    $Id$
 * @author     Tiago Garcia
 * @author     $Author$
 */

namespace   Shopware\Models\Customer;

use Shopware\Components\Model\ModelRepository;
use Doctrine\ORM\Query\Expr;

/**
 * Shopware Payment Data Repository
 */
class PaymentDataRepository extends ModelRepository
{
    /**
     * @param null $userId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCurrentPaymentDataQueryBuilder($userId, $paymentName)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select(array('paymentdata'));
        $builder->from('Shopware\Models\Customer\PaymentData', 'paymentdata')
            ->leftJoin('paymentdata.paymentMean', 'paymentmean')
            ->leftJoin('paymentdata.customer', 'customer')
            ->where('customer.id = :userId')
            ->andWhere("paymentmean.name = :paymentName")
            ->andWhere("paymentmean.active = 1")
            ->setParameters(array(
                'userId' => $userId,
                'paymentName' => $paymentName,
            ));

        return $builder;
    }
}
