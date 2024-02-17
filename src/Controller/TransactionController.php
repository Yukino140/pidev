<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Entity\TransactionType;
use App\Repository\CompteRepository;
use App\Repository\TransactionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    #[Route('/transaction', name: 'app_transaction')]
    public function index(): Response
    {
        return $this->render('transaction/index.html.twig', [
            'controller_name' => 'TransactionController',
        ]);
    }
    #[Route('/getAllTransactions',name:'getAllT')]
    public function getAll(TransactionRepository $repo,CompteRepository $rep):Response
    {
        $client=$rep->find(1);

        $res =$repo->findAll();
        return $this->render('transaction/TransactionsHistory.html.twig',[
            'transac'=> $res,
        ]);
    }

    #[Route('/deposit', name:'depo')]
    public function deposit(Request $req,ManagerRegistry $mg,CompteRepository $rep):Response
    {
        $em = $mg->getManager();
        $transaction=new Transaction();

        $client=$rep->find(1);
        $transaction->setIdCompte($client);
        $transaction->setTypeTransaction(TransactionType::Versement);
        $transaction->setDate(new \DateTime('now'));
        $form=$this->createForm(\App\Form\TransactionType::class,$transaction);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($transaction);
            $em->flush();
            return $this->redirectToRoute('depo');
        }
        return $this->render('transaction/deposit.html.twig',['form'=>$form->createView()]);

    }
    #[Route('/transfer',name:'trans')]
    public function transfers(Request $req, ManagerRegistry $mg,CompteRepository $rep):Response
    {
        $em = $mg->getManager();
        $transaction=new Transaction();
        $client=$rep->find(1);
        $transaction->setIdCompte($client);
        $transaction->setTypeTransaction(TransactionType::Virement);
        $transaction->setDate(new \DateTime('now'));
        $form=$this->createForm(\App\Form\TransactionType::class,$transaction);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($transaction);
            $em->flush();
            return $this->redirectToRoute('trans');
        }
        return $this->render('transaction/transfert.html.twig',['form'=>$form->createView()]);
    }
    #[Route('/withdrawl' ,name:'retrait')]
    public function withdrawal(Request $req, ManagerRegistry $mg,CompteRepository $rep):Response
    {
        $em = $mg->getManager();
        $transaction=new Transaction();
        $client=$rep->find(1);
        $transaction->setIdCompte($client);
        $transaction->setTypeTransaction(TransactionType::Retrait);
        $transaction->setDate(new \DateTime('now'));
        $form=$this->createForm(\App\Form\TransactionType::class,$transaction);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($transaction);
            $em->flush();
            return $this->redirectToRoute('retrait');
        }
        return $this->render('transaction/withdrawl.html.twig',['form'=>$form->createView()]);
    }
}
