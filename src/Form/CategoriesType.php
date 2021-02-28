<?php

namespace App\Form;


use App\Model\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    /**
     * @var Categories
     */
    private Categories $categories;

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => $this->categories->all(),
            'choice_value' => 'id',
            'choice_label' => 'title',
            'multiple' => true
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}