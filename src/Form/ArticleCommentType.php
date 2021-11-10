<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:49 PM
 * Last Modified: 11/9/21, 4:04 PM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleCommentType.php
 */

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, ['label' => 'Comment', 'required' => true])
            ->add('save', SubmitType::class, ['label' => 'Add Comment']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class
        ]);
    }
}
