<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateTodoTest extends TestCase
{
    use DatabaseMigrations;

    protected $factoryTodo;

    protected $payload;

    protected $resposne;

    /**
     * A test example for successfully updating a Todo.
     *
     * @return void
     */
    public function testICanUpdateATodo()
    {
      $this->givenIWantToUpdateATodo();
      $this->andISetTheCompleteStatusToTrue();
      $this->whenIChangeTheTodo();
      $this->thenIshouldSeeTheSuccessfullyUpdatedTodo();
    }

    /**
     * A test example for failing validation rules when updating a Todo.
     *
     * @return
     */
    public function testIAmUnableToUpdateATodo()
    {
      $this->givenIWantToUpdateATodo();
      $this->andISetTheTaskToBeEmpty();
      $this->whenIChangeTheTodo();
      $this->thenIshouldSeeAnErrorMessage();
      $this->andIShouldSeeStatusCode422();
    }

    /**
     * Given I want to update a Todo.
     *
     * @return void
     */
    private function givenIWantToUpdateATodo()
    {
      $this->factoryTodo = factory(App\Models\Todo::class)->create();
    }

    /**
     * And I set the complete status to true.
     *
     * @return void
     */
    private function andISetTheCompleteStatusToTrue()
    {
      $this->payload = $this->factoryTodo->toArray();
      $this->payload['completed'] = true;
    }

    /**
     * When I change the Todo.
     *
     * @return void
     */
    private function whenIChangeTheTodo()
    {
      $model = $this->factoryTodo;
      $this->response = $this->json('PUT', '/api/todos/' . $model->id, $this->payload);
    }

    /**
     * Then I should see the successfully created Todo.
     *
     * @return void
     */
    private function thenIshouldSeeTheSuccessfullyUpdatedTodo()
    {
      $this->response->assertStatus(202);
      $this->response->assertJson($this->payload);
    }

    /**
     * and I set the task to an empty string.
     *
     * @return void
     */
    private function andISetTheTaskToBeEmpty()
    {
      $this->payload = $this->factoryTodo->toArray();
      $this->payload['task'] = '';
    }

    /**
     * Then I should see an error message.
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
     * And I should see status code 422.
     *
     * @return void
     */
    private function andIShouldSeeStatusCode422()
    {
      $this->response->assertStatus(422);
    }

}
