<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Twig\Tests\Extension;

use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Twig\Extension\HttpKernelExtension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class HttpKernelExtensionTest extends TestCase
{
    /**
     * @expectedException \Twig\Error\RuntimeError
     */
    public function testFragmentWithError()
    {
        $renderer = $this->getFragmentHandler($this->throwException(new \Exception('foo')));

        $this->renderTemplate($renderer);
    }

    public function testRenderFragment()
    {
        $renderer = $this->getFragmentHandler($this->returnValue(new Response('html')));

        $response = $this->renderTemplate($renderer);

        $this->assertEquals('html', $response);
    }

    public function testUnknownFragmentRenderer()
    {
        $context = $this->getMockBuilder('Symfony\\Component\\HttpFoundation\\RequestStack')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $renderer = new FragmentHandler(array(), false, $context);

        if (method_exists($this, 'expectException')) {
            $this->expectException('InvalidArgumentException');
            $this->expectExceptionMessage('The "inline" renderer does not exist.');
        } else {
            $this->setExpectedException('InvalidArgumentException', 'The "inline" renderer does not exist.');
        }

        $renderer->render('/foo');
    }

    protected function getFragmentHandler($return)
    {
        $strategy = $this->getMockBuilder('Symfony\\Component\\HttpKernel\\Fragment\\FragmentRendererInterface')->getMock();
        $strategy->expects($this->once())->method('getName')->will($this->returnValue('inline'));
        $strategy->expects($this->once())->method('render')->will($return);

        $context = $this->getMockBuilder('Symfony\\Component\\HttpFoundation\\RequestStack')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $context->expects($this->any())->method('getCurrentRequest')->will($this->returnValue(Request::create('/')));

        return new FragmentHandler(array($strategy), false, $context);
    }

    protected function renderTemplate(FragmentHandler $renderer, $template = '{{ render("foo") }}')
    {
        $loader = new ArrayLoader(array('index' => $template));
        $twig = new Environment($loader, array('debug' => true, 'cache' => false));
        $twig->addExtension(new HttpKernelExtension($renderer));

        return $twig->render('index');
    }
}
