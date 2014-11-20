<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    ###### LS FUNCTION #########





    /**
     * @Given I am in a directory :dir
     */
    public function iAmInADirectory($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        chdir($dir);
    }

    /**
     * @Given I have a file named :file
     */
    public function iHaveAFileNamed($file)
    {
        touch($file);
    }

    /**
     * @When I run :command
     */
    public function iRun($command)
    {
        exec($command, $output);
        $this->output = trim(implode("\n", $output));
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string) $string !== $this->output) {
            throw new Exception(
                "Actual output is:\n" . $this->output
            );
        }
    }


    ######### addAuthor Function ########


    private $post;
    /**
     * @Given model Post
     */
    public function modelPost()
    {
        $post = new \Procreative\BehatInSymfonyBundle\Entity\Post();

        $this->post = $post;
    }



    /**
     * @Given jest model Post
     */
    public function jestModelPost()
    {
        return ($this->post instanceof \Procreative\BehatInSymfonyBundle\Entity\Post);

    }

    /**
     * @Given ma autora Jan
     */
    public function maAutoraJan()
    {
        $author = new \Procreative\BehatInSymfonyBundle\Entity\Author("Jan");
        $this->post->addAuthor($author);
    }

    /**
     * @When dodam do postu autora
     */
    public function dodamDoPostuAutora()
    {
        $anotherAuthor = new \Procreative\BehatInSymfonyBundle\Entity\Author("Ktos inny");
        $this->post->addAuthor($anotherAuthor);
    }

    /**
     * @Then post powinien mieć dwóch autorów
     */
    public function postPowinienMiecDwochAutorow()
    {
        if($this->post->getAuthorCount() !== 2){
            throw new Exception("Counting auhtors is broken");
        }
    }

}
