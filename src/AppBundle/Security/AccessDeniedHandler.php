<?php
/**
 * Created by PhpStorm.
 * User: Szysz
 * Date: 28.10.2017
 * Time: 16:26
 */

namespace AppBundle\Security;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;
    use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler  implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $content = "<h1><i>403 Forbidden - Access Denied</i></h1><br> <a href=\"/\">Back to homepage</a> ";

        return new Response( $content,403);
    }
}