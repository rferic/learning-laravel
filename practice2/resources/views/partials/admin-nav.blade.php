<p class="col-md-6 pull-left">
    {{ link_to_action('Admin\UserController@index', 'Users', [], []) }} |
    {{ link_to_action('Admin\PizzaController@index', 'Pizzas', [], []) }} |
    {{ link_to_action('Admin\IngredientController@index', 'Ingredients', [], []) }} |
    {{ link_to_action('Admin\IngredientPizzaController@index', 'Ingredients & Pizzas', [], []) }}
</p>

<p class="col-md-6 pull-right text-right">
    {{ link_to_action('AdminController@index', 'Admin Panel', []) }}
</p>
<p class="clearfix"></p>
