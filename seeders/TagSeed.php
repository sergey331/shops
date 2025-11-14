<?php
namespace Seeder;
use Kernel\Seeder\Seeder;
class TagSeed extends Seeder
{
    public function run()
    {
        $tags = [
            // General
            'Bestseller', 'New Release', 'Classic', 'Award Winner', 'Editor\'s Pick',
            'Recommended', 'Series', 'Standalone', 'Short Story', 'Anthology',

            // Genres
            'Fiction', 'Non-Fiction', 'Mystery', 'Thriller', 'Romance', 'Fantasy',
            'Science Fiction', 'Historical', 'Horror', 'Adventure', 'Drama',
            'Comedy', 'Biography', 'Memoir', 'Poetry', 'Philosophy', 'Religion',
            'Self-Help', 'Science', 'Business', 'Politics', 'Art', 'Psychology',
            'Technology', 'Travel', 'Education', 'Health & Fitness', 'Cookbooks',
            'Parenting',

            // Audience
            'Children', 'Young Adult', 'Adult', 'Teens', 'Family', '18+',

            // Time Period
            'Contemporary', 'Modern', 'Historical', 'Medieval', 'Ancient',
            'Futuristic', 'Post-Apocalyptic',

            // Themes
            'Friendship', 'Love', 'Betrayal', 'Revenge', 'War', 'Survival', 'Hope',
            'Justice', 'Freedom', 'Dreams', 'Adventure', 'Coming of Age', 'Magic',
            'Space', 'Technology', 'Nature', 'Spirituality', 'Crime', 'Detective',
            'Supernatural', 'Courage', 'Loss', 'Faith', 'Family', 'Destiny',
            'Conflict', 'Forgiveness', 'Sacrifice', 'Redemption',

            // Setting
            'Urban', 'Rural', 'Fantasy World', 'Outer Space', 'Underwater',
            'Small Town', 'City Life', 'School', 'Workplace', 'Historical Europe',
            'Ancient Rome', 'Future Earth', 'Desert', 'Mountains', 'Island',

            // Style
            'First-Person', 'Third-Person', 'Epistolary', 'Stream of Consciousness',
            'Nonlinear', 'Minimalist', 'Symbolic', 'Satire', 'Dark Humor', 'Narrative',

            // Language / Region (optional)
            'English', 'German', 'French', 'Spanish', 'Japanese', 'Chinese', 'Russian',
            'Italian', 'Korean', 'Arabic'
        ];

        foreach ($tags as $tag) {
            $this->model('Tag')->create([
                'name' => $tag,
                'slug' => strtolower(str_replace([' ', '+'], ['-', 'plus'], $tag)),
            ]);
        }
    }
}