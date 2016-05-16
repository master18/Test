<?php

/*
 * This file is part of the GenemuFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace px\FormBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Upload Controller
 *
 * @author Olivier Chauvel <olivier@generation-multiple.com>
 */
class UploadController extends ContainerAware
{
    /**
     * Lists all Item entities.
     *
     * @Route("/upload", name="px_upload")
     * @Method("POST")
     * @Template()
     */
    public function uploadAction()
    {
        $handle = $this->container->get('request')->files->get('Filedata');

        $folder = $this->container->getParameter('px.form.file.folder');
        $uploadDir = $this->container->getParameter('px.form.file.upload_dir');
        $name = uniqid() . '.' . $handle->guessExtension();

        $json = array();
        if ($handle = $handle->move($uploadDir, $name)) {
            $json = array(
                'result' => '1',
                'file' => ''
            );
            $json['file'] = $folder . '/' . $handle->getFilename() . '?' . time();
        } else {
            $json['result'] = '0';
        }

        return new Response(json_encode($json));
    }
}
