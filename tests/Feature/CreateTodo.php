<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


/**
 *
 * @feature Create a Todo
 *
 *
 */
class CreateTodo extends TestCase
{
	use WithoutMiddleware;

	/* the data being passed through API call */
	protected $payload;

	/* the output of the API call*/
	protected $response;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testiCanCreateATodo()
    {
        $this->givenIWantToCreateATodo();
        $this->whenICreateTheTodoWithATask();
        $this->thenIShouldSeeTheSuccessfullyCreatedTodo();
    }

    public function testiAmUnableToCreateATodo()
    {
    	$this->givenIWantToCreateATodo();
    	$this->whenICreateTheTodoWithoutATask();
    	$this->thenIshouldSeeAnErrorMessage();
    	$this->andIShouldSeeStatusCode422();
    }

    /** 
     * Given I want to create a todo.
     *
     * @return void
     */
    private function givenIWantToCreateATodo
    {
    	$this->payload = factory(App\Todo::class)->make();
    }

    
    /** 
     * When I create the Todo with a task.
     *
     * @return void
     */
    private function whenICreateTheTodoWithATask()
    {
    	$this->response = $this->json('POST', '/api/todos/', $this->payload);
    }

    /** 
     * Then I should see the successfully created Todo.
     *
     * @return void
     */
    private function thenIShouldSeeTheSuccessfullyCreatedTodo()
    {
    	$this->response->assertStatus(201);
    	$this->response->assertJsonFragment($this->payload);
    }

    /** 
     * When I create the Todo with a task.
     *
     * @return void
     */
    private function whenICreateTheTodoWithoutATask()
    {
    	$this->payload->task = '';
    	$this->response = $this->json('POST', '/api/todos/', $this->payload);
    }

    /**
     * Then I should see an error message
     *
     * @return void
     */
    private function thenIshouldSeeAnErrorMessage()
    {
    	$this->response->assertJsonStructure([
    		'errors' => [ 
    			'task'
    		]
    	]);
    }

    /**
     * and I should see status code 422
     *
     * @return void
     */
    private function andIShouldSeeStatusCode422()
    {
    	$this->response->assertStatus(422);
    }
}
