<p class="col-md-6 pull-left">
    <!-- TODO print links to controllers -->
    {{ link_to_action('PizzaController@create', 'Create a pizza', [], []) }} |
    {{ link_to_action('PizzaController@index', 'My pizzas', [], []) }} |
    {{ link_to_action('IngredientController@create', 'Create a ingredient', [], []) }} |
    {{ link_to_action('IngredientController@index', 'Ingredients', [], []) }}
</p>

<!--TODO validate if user have role admin -->
@if(auth()->user()->role_id === 1)
    <p class="col-md-6 pull-right text-right">
        {{ link_to_route('admin.index', 'Admin', []) }} <!--TODO print link to view -->
    </p>
@endif
<p class="clearfix"></p>
