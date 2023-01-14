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
    public function index(
        ManagerRegistry $doctrine,
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository,
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

        $em = $doctrine->getManager();
        $data = json_decode($request->getContent());
    
        $email = $data->email;
        $usrname = $data->username;
        $lname = $data->lastname;
        $fname = $data->firstname;
        $mobile = $data->mobile;

        $email = $em->getRepository(User::class)->findOneBy(['email' => $email]);
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
        $user->setEmail($email);
        $user->setMobile($mobile);
        $user->setLastname($lname);
        $user->setFirstname($fname);
        $user->setUsername($usrname);
        $user->setToken(0);
        $user->setMailtoken(0);
        $user->setIsblocked(0);
        $user->setIsactivated(0);
        $user->setCreatedAt(new Datetime('now'));
        $user->setRoles(["ROLE_USER"]);
        $em->persist($user);
        $em->flush();
  
        return $this->json(['statuscode' => 200,'message' => 'records inserted.']);

        // // return $this->json($data);
        // $repoPost = $doctrine->getManager();
        // $x1 = $userRepository->
        // $repository = $repoPost->getRepository(User::class);
        // // $product = $repository->find($id);
        // // $repoPost = $this->getDoctrine()->getRepository(User::class);

        // $userEmail = $repoPost->findOneBy(['email' => $data->email]);
        // if ($userEmail != null) {
        //     return $this->json([
        //         'message' => 'Email Address is already taken.'
        //     ]);
        // } else {
        //     return $this->json([
        //         'message' => 'Email Address is available.'
        //     ]);
        // }

        // $user = new User();
        // $user->setEmail($data->email);
        // $user->setPassword($passwordEncoder->encodePassword($user, $data->password));
        // $user->setRoles(["ROLE_USER"]);

        // $em = $this->getDoctrine()->getManager();
        // $em->persist($user);
        // $em->flush();

        // return $guardHandler->authenticateUserAndHandleSuccess(
        //     $user,          // the User object you just created
        //     $request,
        //     $authenticator,'main' // authenticator whose onAuthenticationSuccess you want to use
        //     //'main'          // the name of your firewall in security.yaml
        // );


        // return $this->json([
        //     'message' => 'New User ID No. ' . $user->getId() . ' has been created.',
        // ]);
    }
}