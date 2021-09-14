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
        //Return results if present (converting from boolean values to Yes/No for readability)
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
        //Define instance of Checker class
        $checker = new Checker();

        //Get the word and comparison word phrase from the frontend submission
        $word = $request->request->get('word');
        $comparison = $request->request->get('comparison');

        if (empty($word)) {
            //No word specified, redirect to frontend with an error message

            $this->addFlash(
                'notice', 'No word or sentence entered.'
            );

            return $this->redirectToRoute("index");
        }

        //Run functions to check word and redirect to the homepage with the results
        return $this->redirectToRoute('index', [
            'isPalindrome' => $checker->isPalindrome($word), 
            'isAnagram' => $checker->isAnagram($word, $comparison), 
            'isPangram' => $checker->isPangram($word), 
            'word' => $word,
            'comparison' => $comparison
        ]);
    }
}