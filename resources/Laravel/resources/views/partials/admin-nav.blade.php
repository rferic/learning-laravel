<div class="col-md-12">
    {{ link_to_action('Admin\PizzaController@index', 'Pizzas', [], []) }} |
    {{ link_to_action('Admin\UserController@index', 'Usuarios', [], []) }} |
    {{ link_to_action('Admin\IngredientController@index', 'Ingredientes', [], []) }} |
    {{ link_to_action('Admin\IngredientPizzaController@index', 'Ingredient y Pizzas', [], []) }} |
    {{ link_to_action('AdminController@index', 'Administración', []) }}
</div>

<hr />