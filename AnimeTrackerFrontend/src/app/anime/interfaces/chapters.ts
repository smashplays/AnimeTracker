import { ChapterInfo } from './chapter-info';
export interface Chapters {
  id: number;
  name: string;
  aired: string;
  anime_id: number;
}


export interface ChaptersI{
  user_id:number,
  anime_chapter_id:number
  watched:boolean
}


export interface ChaptersA{
  name:string,
  aired:string
  anime_id:number
}
