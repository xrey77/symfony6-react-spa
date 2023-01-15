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

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/api", name="api_")
 */
class UserController extends AbstractController
{


    public function sendEmail(
        string $from,
        string $to,
        string $subject,
        string $msg,
        MailerInterface $mailer): Response
    {
        try {
            $email = (new Email())
                ->from($from)
                ->to($to)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($subject)
                // ->text($msg)
                ->html('<p>'. $msg . '</p>');

            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return $e;
        }
    }


    /**
     * @Route("/getallusers", name="getallusers", methods={"GET"})
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

        $query = $em->createQuery(
            'SELECT u.id,u.firstname,u.lastname,u.mobile,u.roles,u.isactivated,u.isblocked,u.userpic,u.created_at,u.updated_at
            FROM App\Entity\User u
            ORDER BY u.id ASC'
        );
        //->setParameter('price', $price);
        return $this->json($query->getResult());
    }

    /**
     * @Route("/getuserbyid/{id}", name="getuserbyid", methods={"GET"})
     * 
     */
    public function getuserbyid(
        int $id,
        ManagerRegistry $doctrine,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager    
    ): Response
    {

        $em = $doctrine->getManager();

        $query = $em->createQuery(
            'SELECT u.id,u.firstname,u.lastname,u.mobile,u.roles,u.isactivated,u.isblocked,u.userpic,u.created_at,u.updated_at
            FROM App\Entity\User u
            WHERE u.id = :id
            ORDER BY u.id ASC'
        )->setParameter('id', $id);
        if ($query->getResult() != null) {
            return $this->json($query->getResult());
        } else {
            return $this->json(['statuscode' => 404,'message' => 'User ID not found.']);
        }
    }

    /**
     * @Route("/blockuser/{id}", name="blockuser", methods={"PUT"})
     * 
     */
    public function blockuser(
        int $id,
        ManagerRegistry $doctrine,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager    
    ): Response
    {

        $em = $doctrine->getManager();
        $username = $em->getRepository(User::class)->find($id);
        if ($username) {
            $username->setIsblocked(1);
            $em->flush();
            return $this->json(['statuscode' => 200,'message' => 'User has been blocked.']);
        } else {
            return $this->json(['statuscode' => 404,'message' => 'User ID not found.']);
        }
    }

    /**
     * @Route("/deleteuser/{id}", name="deleteuser", methods={"DELETE"})
     * 
     */
    public function deleteuser(
        string $id,
        ManagerRegistry $doctrine,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager    
    ): Response
    {
        if (!is_numeric($id)) {
            return $this->json(['statuscode' => 406,'message' => 'User ID should be numeric.']);
        } else {

            $em = $doctrine->getManager();
            $username = $em->getRepository(User::class)->find($id);
            if ($username) {
                $em->remove($username);
                $em->flush();
                return $this->json(['statuscode' => 200,'message' => 'User has been deleted.']);
            } else {
                return $this->json(['statuscode' => 404,'message' => 'User ID not found.']);
            }
        }    
    }

    /**
     * @Route("/acitvateuser/{mailtoken}", name="acitvateuser", methods={"PUT"})
     * 
     */
    public function acitvateuser(
        int $mailtoken,
        ManagerRegistry $doctrine,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager    
    ): Response
    {

        $em = $doctrine->getManager();
        $username = $em->getRepository(User::class)->findOneBy(['mailtoken' => $token]);
        if ($username) {
            $username->setIscactivated(1);
            $em->flush();
            return $this->json(['statuscode' => 200,'message' => 'User has been activated.']);
        } else {
            return $this->json(['statuscode' => 404,'message' => 'User ID not found.']);
        }
    }

    /**
     * @Route("/forgotpassword/{id}", name="forgotpassword", methods={"PUT"})
     * 
     */
    public function forgotpassword(
        int $id,
        ManagerRegistry $doctrine,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager    
    ): Response
    {

        $em = $doctrine->getManager();
        $username = $em->getRepository(User::class)->find($id);
        if ($username) {
            //send mail token here
            $mailtoken = random_int(100000, 999999);
            // $this->sendEmail()

            return $this->json($mailtoken);
        } else {
            return 0;
        }


    }





}
