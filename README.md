# br-shoes-ecommerce
BR SHOES e-commerce app

https://laracasts.com/series/learn-vue-2-step-by-step
https://laracasts.com/series/whats-new-in-vue-3
https://laracasts.com/series/testing-vue
https://laracasts.com/series/alpine-essentials
https://laracasts.com/series/laravel-6-from-scratch

https://joey.io/ecommerce-modeling-exercise-product-variants/
https://guides.spreecommerce.org/developer/core/products.html


products
	id: p-1
	name: Snake Sneaker
	description: Snake printed style Sneaker
	slug: snake-sneaker

product_property_types
    id: ppt-1
    name: marca

    id: ppt-2
    name: modelo

product_properties
    ## Producto: 1, Marca: BR-SHOES
    id: pp-1
    product_id: p-1
    property_type_id: ppt-1
    value: BR-SHOES

    ## Producto: 1, Modelo: Snake Sneaker
    id: pp-2
    product_id: p-1
    property_type_id: ppt-2
    value: Snake Sneaker

option_types
	id: ot-1
	product_id: p-1
	name: size
	
	id: ot-2
	product_id: p-1
	name: color

option_values
    ## Size 24
	id: ov-1
	option_type_id: ot-1
	value: 24

    ## Size 23
	id: ov-2
	option_type_id: ot-1
	value: 23
	
    ## Color blanco
	id: ov-3
	option_type_id: ot-1
	value: blanco
	
	## Color rosa
    id: ov-4
	option_type_id: ot-1
	value: rosa

variants
	## master variant, todo producto tiene una varainte maestra
	id: v-1
	product_id: p-1
	price_cents: 35000
	is_master: true
	
    
	## Size: 23 Color: blanco, las variantes normales representan a productos con atributos especificos
	id: v-2
	product_id: p-1
	price_cents: 25000
	is_master: false

option_value_variants
	## Variante v-2, atributo: 24 de tipo Size
    option_value_id: ov-2
	variant_id: v-2
	
    ## Variante v-2, atributo: rosa de tipo Color
	option_value_id: ov-3
	variant_id: v-2
