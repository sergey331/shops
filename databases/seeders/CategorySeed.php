<?php
namespace Seeder;
use Kernel\Seeder\Seeder;
class CategorySeed extends Seeder
{
    public function run()
    {
        $data =  [
            ['name' => 'Fiction', 'description' => 'Imaginative or made-up stories', 'logo' => 'fiction.png'],
            ['name' => 'Non-Fiction', 'description' => 'Real-world facts, biographies, and knowledge', 'logo' => 'non_fiction.webp'],
            ['name' => 'Mystery & Thriller', 'description' => 'Suspenseful stories with crime or investigation', 'logo' => 'mystery_thriller.webp'],
            ['name' => 'Romance', 'description' => 'Love stories and relationships', 'logo' => 'romance.jpeg'],
            ['name' => 'Science Fiction', 'description' => 'Futuristic, space, or technology-based stories', 'logo' => 'science_fiction.png'],
            ['name' => 'Fantasy', 'description' => 'Magic, mythical creatures, and other worlds', 'logo' => 'fantasy.jpg'],
            ['name' => 'Historical Fiction', 'description' => 'Stories set in the past', 'logo' => 'historical_fiction.jpg'],
            ['name' => 'Horror', 'description' => 'Scary and supernatural stories', 'logo' => 'horror.jpg'],
            ['name' => 'Biography & Memoir', 'description' => 'Real-life stories of people', 'logo' => 'biography_memoir.webp'],
            ['name' => 'Self-Help', 'description' => 'Guides for personal growth and motivation', 'logo' => 'self_help.jpg'],
            ['name' => 'Business & Economics', 'description' => 'Finance, leadership, and entrepreneurship', 'logo' => 'business_economics.jpg'],
            ['name' => 'Science & Technology', 'description' => 'Research, inventions, and discoveries', 'logo' => 'science_technology.jpg'],
            ['name' => 'Health & Fitness', 'description' => 'Physical and mental well-being', 'logo' => 'fitness.jpg'],
            ['name' => 'Children’s Books', 'description' => 'Stories for kids', 'logo' => 'childrens.jpg'],
            ['name' => 'Comics & Graphic Novels', 'description' => 'Illustrated storytelling', 'logo' => 'comics.jpg'],
            ['name' => 'Poetry', 'description' => 'Collections of poems', 'logo' => 'poetry.jpg'],
            ['name' => 'Travel & Adventure', 'description' => 'Exploration and destinations', 'logo' => 'travel.jpeg'],
            ['name' => 'Cooking & Food', 'description' => 'Recipes and culinary arts', 'logo' => 'cooking.webp'],
            ['name' => 'Religion & Spirituality', 'description' => 'Faith, belief, and philosophy', 'logo' => 'religion.png'],
            ['name' => 'Education & Reference', 'description' => 'Academic or instructional content', 'logo' => 'reference.jpg'],
            ['name' => 'Art & Photography', 'description' => 'Visual arts and design', 'logo' => 'photography.jpg'],
            ['name' => 'Politics & Social Issues', 'description' => 'Governance, activism, and culture', 'logo' => 'politics.jpg'],
        ];


        foreach ($data as $category) {
            $this->model('Category')->create([
                'name' => $category['name'],
                'description' => $category['description'],
                'logo' => $category['logo'],
            ]);
        }
    }
}