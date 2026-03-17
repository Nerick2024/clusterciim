import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

const newsEs = defineCollection({
  loader: glob({ pattern: '*.md', base: './src/content/News/es' }),
  schema: z.object({
    id: z.string(),
    title: z.string(),
    description: z.string(),
    image: z.string(),
    date: z.coerce.date(),
    category: z.string().default('Uncategorized'),
  }),
});

const newsEn = defineCollection({
  loader: glob({ pattern: '*.md', base: './src/content/News/en' }),
  schema: z.object({
    id: z.string(),
    title: z.string(),
    description: z.string(),
    image: z.string(),
    date: z.coerce.date(),
    category: z.string().default('Uncategorized'),
  }),
});

export const collections = {
  'news-es': newsEs,
  'news-en': newsEn,
};
