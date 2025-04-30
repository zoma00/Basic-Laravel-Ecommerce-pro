<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit  Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">



                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">  <!-- Fixed missing closing quote -->

                            <!-- Fix form action and method -->
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf 
                            @method('PUT')  <!-- Add method spoofing for PUT -->
                            
                    <div class="form-group">
                    <label for="categoryName">Update Category Name</label>
                    <input type="text" name="category_name" class="form-control" 
                        id="categoryName" 
                        value="{{ old('category_name', $category->category_name) }}">  <!-- Merge old() and category data -->
                        

                    
                        @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                    
                    <button type="submit" class="btn btn-primary">Update Category</button>
            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
