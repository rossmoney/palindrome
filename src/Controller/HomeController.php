<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Checker;

class HomeController extends AbstractController
{
     /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        return $this->render('home/index.html.twig', [
            'isPalindrome' => $request->get('isPalindrome') ? 'yes' : 'no', 
            'isAnagram' => $request->get('isAnagram') ? 'yes' : 'no', 
            'isPangram' => $request->get('isPangram') ? 'yes' : 'no', 
            'word' =>  $request->get('word'),
            'comparison' =>  $request->get('comparison')
        ]);
    }

    /**
     * @Route("/", name="check_word")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function checkWord(Request $request)
    {
        $checker = new Checker();

        $word = $request->request->get('word');
        $comparison = $request->request->get('comparison');

        if (empty($word)) {
            $this->addFlash(
                'notice', 'No word or sentence entered.'
            );

            return $this->redirectToRoute("index");
        }

        $isPalindrome = $checker->isPalindrome($word);
        $isAnagram = $checker->isAnagram($word, $comparison);
        $isPangram = $checker->isPangram($word);

        return $this->redirectToRoute('index', [
            'isPalindrome' => $isPalindrome, 
            'isAnagram' => $isAnagram, 
            'isPangram' => $isPangram, 
            'word' => $word,
            'comparison' => $comparison
        ]);

    }
}