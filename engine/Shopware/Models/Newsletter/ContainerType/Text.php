<?php
/**
 * Shopware 4.0 - Dispatch
 * Copyright © 2012 shopware AG
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
 * @subpackage Backend, Newsletter/ContainerType
 * @copyright  Copyright (c) 2012, shopware AG (http://www.shopware.de)
 * @version    $Id$
 * @author     Daniel Nögel
 * @author     $Author$
 */

namespace   Shopware\Models\Newsletter\ContainerType;
use         Shopware\Components\Model\ModelEntity,
            Doctrine\ORM\Mapping AS ORM;

/**
 * Shopware text model represents a text container type.
 *
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_campaigns_html")
 */
class Text extends ModelEntity
{
    /**
     * Autoincrement ID
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * ID of the container this model belongs to
     *
     * @var integer $containerId
     *
     * @ORM\Column(name="parentID", type="integer", length=11, nullable=true)
     */
    private $containerId = null;

    /**
     * OWNING SIDE
     * Owning side of relation between container type 'text' and parent container
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Newsletter\Container", inversedBy="text")
     * @ORM\JoinColumn(name="parentID", referencedColumnName="id")
     * @var \Shopware\Models\Newsletter\Container
     */
    protected $container;

    /**
     * Headline of the element
     *
     * @var string $headline
     * @ORM\Column(name="headline", type="string", length=255, nullable=false)
     */
    private $headline;

    /**
     * (HTML) content of the model
     *
     * @var string $content
     * @ORM\Column(name="html", type="string", length=16777215 , nullable=false)
     */
    private $content;

    /**
     * @var string $image
     * @ORM\Column(name="image", type="string", length=255 , nullable=false)
     */
    private $image;

    /**
     * @var string $link
     * @ORM\Column(name="link", type="string", length=255 , nullable=false)
     */
    private $link;

    /**
     * @var string $alignment
     * @ORM\Column(name="alignment", type="string", length=255 , nullable=false)
     */
    private $alignment;

    /**
     * @param string $alignment
     */
    public function setAlignment($alignment)
    {
        $this->alignment = $alignment;
    }

    /**
     * @return string
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * @param \Shopware\Models\Newsletter\Container $container
     * @param string $type
     * @return \Shopware\Models\Newsletter\Container
     */
    public function setContainer($container, $type='ctText')
    {
        $this->container = $container;
        $container->setType($type);
//        return $this->setOneToOne($container, '\Shopware\Models\Newsletter\Container', 'container', 'text');
    }

    /**
     * @return \Shopware\Models\Newsletter\Container
     */
    public function getContainer()
    {
        return $this->container;
    }


    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}

