<footer class="flex justify-center text-gray-100 bg-gray-800 footer">
	<div class="container px-6 py-6">
		<h1 class="text-lg font-bold text-center lg:text-2xl">
			Join 31,000+ other and never miss <br> out on new tips, tutorials, and more.
		</h1>

		<div class="flex justify-center mt-6">
			<div class="bg-white rounded-md">
				<div class="flex flex-wrap justify-between md:flex-row">
					<input type="email" class="p-2 m-1 text-sm text-gray-700 appearance-none focus:outline-none focus:placeholder-white" placeholder="Enter your email" aria-label="Enter your email">
					<button class="w-full p-2 m-1 text-sm font-semibold uppercase bg-gray-800 rounded lg:w-auto hover:bg-gray-700">subscribe</button>
				</div>
			</div>
		</div>

		<hr class="h-px mt-6 bg-gray-700 border-none">

		<div class="flex flex-col items-center justify-between mt-6 md:flex-row">
			<div>
				<a href="#" class="text-xl font-bold text-gray-100 hover:text-gray-400">
					{{
						config('constants.bussines_name')
					}}
				</a>
				<p>
					{{
						__('messages.copyright', [
							'year' => now()->year,
							'copyright_owner' => config('constants.bussines_name')
						])
					}}
				</p>
			</div>

			<div class="flex mt-4 md:m-0">
				<div class="-mx-4">
					<a href="#" class="px-4 text-sm font-medium text-gray-100 hover:text-gray-400">About</a>
					<a href="#" class="px-4 text-sm font-medium text-gray-100 hover:text-gray-400">Blog</a>
					<a href="#" class="px-4 text-sm font-medium text-gray-100 hover:text-gray-400">News</a>
					<a href="#" class="px-4 text-sm font-medium text-gray-100 hover:text-gray-400">Contact</a>
				</div>
			</div>
		</div>
	</div>
</footer>