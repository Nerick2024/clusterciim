import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

const newsEs = defineCollection({
  loader: glob({ pattern: '*.md', base: './src/content/news/es' }),
  schema: z.object({
    title: z.string(),
    description: z.string(),
    image: z.string(),
    date: z.coerce.date(),
  }),
});

const newsEn = defineCollection({
  loader: glob({ pattern: '*.md', base: './src/content/news/en' }),
  schema: z.object({
    title: z.string(),
    description: z.string(),
    image: z.string(),
    date: z.coerce.date(),
  }),
});

export const collections = {
  'news-es': newsEs,
  'news-en': newsEn,
};
