<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use App\Entity\User;

/**
 * @Route("/api", name="api_")
 */
class LoginController extends AbstractController
{    
    /**
     * @Route("/login", name="login", methods={"POST"})
     * 
     */
    public function index(
        ManagerRegistry $doctrine,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager    
    ): Response
    {

        $em = $doctrine->getManager();
        $data = json_decode($request->getContent());
        
        $username = $em->getRepository(User::class)->findOneBy(['username' => $data->username]);
        if ($username != null) {
            if ($username->getIsactivated()== 0) {
                return $this->json([
                    'statuscode' => 201,'message' => 'Your account is not yet activated, please check your email inbox and activate.'
                ]);    
            } else {

                if ($username->getIsblocked() == 0) {

                    if (password_verify($data->password,$username->getPassword())) {

                        // =====START GENERATE TOKEN=====                    
                        // $payload = [
                        //     "exp"  => (new \DateTime())->modify("+8 hours")->getTimestamp(),
                        //     "username" => $username->getEmail().'.'.$username->getUsername(),
                        // ];                    
                        // ======END GENERATE TOKEN======

                        return $this->json([
                            'fullname' => $username->getFirstname() . ' ' . $username->getLastname() ,
                            'username' => $username->getUsername(),
                            'email' => $username->getEmail(),
                            'isactivated' => $username->getIsactivated(),
                            'isblocked' => $username->getIsblocked(),
                            'userpicture' => $username->getUserpic(),
                            'token' => $JWTManager->create($username)]
                        );

                    } else {
                        return $this->json([
                            'statuscode' => 201,'message' => 'Incorrect Password.'
                        ]);        
                    }
                } else {

                    return $this->json([
                        'statuscode' => 400,'message' => 'You account has been blocked.'
                    ]);        

                }
            }
        } else {
            return $this->json([
                'statuscode' => 201,'message' => 'Username does not exists, please register.'
            ]);
        }
    }
}