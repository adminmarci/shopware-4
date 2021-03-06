<?php
/**
 * Shopware 4.0
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
 * @subpackage Blog
 * @copyright  Copyright (c) 2012, shopware AG (http://www.shopware.de)
 * @version    $Id$
 * @author     $Author$
 */

namespace Shopware\Models\Blog;
use Shopware\Components\Model\ModelEntity,
Doctrine\ORM\Mapping AS ORM,
Symfony\Component\Validator\Constraints as Assert,
Doctrine\Common\Collections\ArrayCollection;
/**
 * todo@all: Documentation
 *
 * @ORM\Entity
 * @ORM\Table(name="s_blog_media")
 */
class Media extends ModelEntity
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $blogId
     * @ORM\Column(name="blog_id", type="integer", nullable=false)
     */
    private $blogId;

    /**
     * @var integer $mediaId
     * @ORM\Column(name="media_id", type="integer", nullable=false)
     */
    private $mediaId;

    /**
     * @var integer $preview
     * @ORM\Column(name="preview", type="boolean", nullable=false)
     */
    private $preview;

    /**
     * OWNING SIDE
     * @var Blog
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Blog\Blog", inversedBy="media")
     * @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
     */
    protected $blog;

    /**
     * OWNING SIDE
     * @var Media
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Media\Media", inversedBy="blogMedia")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;


    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Preview
     *
     * @return int
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Set Preview
     *
     * @param int $preview
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    /**
     * Get Blog
     *
     * @return \Shopware\Models\Blog\Blog
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Set Blog
     *
     * @param \Shopware\Models\Blog\Blog $blog
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;
    }

    /**
     * @return \Shopware\Models\Blog\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param \Shopware\Models\Blog\Media $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }
}
