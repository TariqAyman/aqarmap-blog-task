<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:49 PM
 * Last Modified: 11/10/21, 4:23 AM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleType.php
 */

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title', 'required' => true])
            ->add('content', TextareaType::class, ['label' => 'Details', 'required' => true])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Categories which article belong to',
                'choices' => $options['categoriesOptions'],
                'choice_name' =>  'id',
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ])
            ->add('save', SubmitType::class, ['label' => 'Add Article']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'categoriesOptions' => [] // default value for category multi-choose field
        ]);
    }
}
