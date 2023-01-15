<?php

namespace App\Controller;

use DateTime;
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
class RegisterController extends AbstractController
{

    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(
        ManagerRegistry $doctrine,
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository
        ): Response
    {
        //=====GET CLIENT TIMEZONE========
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipInfo = file_get_contents('http://ip-api.com/json/');
        $ipInfo = json_decode($ipInfo);                
        $tz = $ipInfo->timezone ?? "UTC";

        //======SET TIMEZONE========
        date_default_timezone_set($tz);

        // $now = new \DateTimeImmutable();
        // $dt = $now->format('Y-m-d H:i:s');

        $data = json_decode($request->getContent());
        $em = $doctrine->getManager();
        $email = $em->getRepository(User::class)->findOneBy(['email' => $data->email]);
        if ($email != null) {
            return $this->json([
                'statuscode' => 201,'message' => 'Email Address is already taken.'
            ]);
        }
        $plaintextPassword = $data->password;
        $user = new User();
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setEmail($data->email);
        $user->setMobile($data->mobile);
        $user->setLastname($data->lastname);
        $user->setFirstname($data->firstname);
        $user->setUsername($data->username);
        $user->setUserpic('https://127.0.0.1:8000/images/user.jpeg');
        $user->setToken(0);
        $user->setMailtoken(0);
        $user->setIsblocked(0);
        $user->setIsactivated(0);
        $user->setCreatedAt(new Datetime('now'));
        $user->setRoles(["ROLE_USER"]);
        $em->persist($user);
        $em->flush();
        return $this->json(['statuscode' => 200,'message' => 'records inserted.']);
    }
}