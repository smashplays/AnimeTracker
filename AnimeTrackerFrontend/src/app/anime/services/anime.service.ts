import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Anime } from '../interfaces/anime';
import { map, Observable, of } from 'rxjs';
import { Characters } from '../interfaces/characters';
import { AnimeSearch, Data } from '../interfaces/anime-search';
import { AnimeAdd } from '../interfaces/anime-add';
import { Respuesta } from 'src/app/user/interfaces/user';
import { AnimeUser } from '../interfaces/anime-user';
import { Episode } from '../interfaces/episodes';
import { Chapters, ChaptersI, ChaptersA } from '../interfaces/chapters';
import { ChapterInfo } from '../interfaces/chapter-info';
import { ChapterUser } from '../interfaces/chapter-user';
import { UserAnime } from '../interfaces/user-anime';

@Injectable({
  providedIn: 'root',
})
export class AnimeService {
  constructor(private http: HttpClient) {}

  private animeUrl: string = 'https://api.jikan.moe/v4/anime';
  private URL: string = 'http://localhost:8000/api/';

  private headers = new HttpHeaders()
    .set('content-type', 'application/json')
    .set('Access-Control-Allow-Origin', '*')
    .set('Authorization', 'Bearer ' + localStorage.getItem('token'));

  public getAnimeById(id: number): Observable<Anime> {
    return this.http
      .get<Anime>(this.animeUrl + '/' + id)
      .pipe(map((resp: Anime) => resp));
  }

  public getAnimeEpisodes(id: number): Observable<Episode> {
    return this.http
      .get<Episode>(this.animeUrl + '/' + id + '/episodes')
      .pipe(map((resp: Episode) => resp));
  }

  public getAnimeChaptersInfo(id: number): Observable<ChapterInfo> {
    return this.http
      .get<ChapterInfo>(this.URL + 'chapters/anime/' + id)
      .pipe(map((resp: ChapterInfo) => resp));
  }

  public chapterByIdUser(id: number): Observable<ChapterUser> {
    return this.http
      .get<ChapterUser>(this.URL + 'users/' + id +'/chapters')
      .pipe(map((resp: ChapterUser) => resp));
  }

  public chapterByAnimeByIdUser(user: number, anime: number): Observable<ChapterUser>{
    return this.http
      .get<ChapterUser>(this.URL + 'users/' + user +'/chapters/' + anime)
      .pipe(map((resp: ChapterUser) => resp));
  }

  public toggleWatch(id: number, watched: boolean): Observable<UserChapter>{
    let data = {
      watched: watched
    };
    return this.http.patch<UserChapter>(this.URL + 'chapters-user/' + id, data, {
      headers: this.headers,
    })
  }


  public getAnimeSearch(query: string): Observable<Data[]> {
    if (!query.trim()) {
      return of([]);
    }
    return this.http
      .get<AnimeSearch>(this.animeUrl + '?q=' + query)
      .pipe(map((resp: AnimeSearch) => resp.data));
  }

  public getAnimeCharacters(id: number): Observable<Characters> {
    return this.http
      .get<Characters>(this.animeUrl + '/' + id + '/characters')
      .pipe(map((resp: Characters) => resp));
  }

  public getAnimePopular(page: number): Observable<AnimeSearch> {
    return this.http
      .get<AnimeSearch>(
        this.animeUrl + '?page=' + page + '&order_by=score' + '&sort=desc'
      )
      .pipe(map((resp: AnimeSearch) => resp));
  }

  public getAnimesByUser(id: number): Observable<AnimeUser> {
    return this.http.get<AnimeUser>(this.URL + 'users/' + id + '/animes').pipe(
      map((res: AnimeUser) => {
        console.log(res);
        return res;
      })
    );
  }

  public addAnime(data: AnimeAdd): Observable<AnimeAdd> {
    return this.http.post<AnimeAdd>(this.URL + 'animes', data, {
      headers: this.headers,
    });
  }

  public addAnimeEpisodes(
    data:ChaptersA[]
  ): Observable<Chapters> {
    // let data = {
    //   name: name,
    //   aired: aired,
    //   anime_id: anime_id,
    // };
    return this.http.post<Chapters>(this.URL + 'chapters', data, {
      headers: this.headers,
    });
  }

  public addAnimeUser(user: number, anime: number): Observable<AnimeAdd> {
    let data = {
      user_id: user,
      anime_id: anime,
    };
    return this.http.post<AnimeAdd>(this.URL + 'anime-user', data, {
      headers: this.headers,
    });
  }

  public addChapterUser(
    data:ChaptersI[]
  ): Observable<ChapterInfo> {
    // let data = {
    //   watched: false,
    //   user_id: user_id,
    //   anime_chapter_id: anime_chapter_id,
    // };
    return this.http.post<ChapterInfo>(this.URL + 'chapters-user', data, {
      headers: this.headers,
    });
  }

  public deleteAnime(id: number): Observable<AnimeAdd> {
    return this.http.delete<AnimeAdd>(this.URL + `animes/${id}`, {
      headers: this.headers,
    });
  }

  public checkAnime(id: number): Observable<boolean> {
    return this.http
      .get<Respuesta>(this.URL + `animes/${id}`, { headers: this.headers })
      .pipe(
        map((res) => {
          if (!res.success) {
            return false;
          } else {
            return true;
          }
        })
      );
  }

  public checkAnimeUser(user: number, anime: number): Observable<boolean> {
    return this.http
      .get<Respuesta>(this.URL + `anime-user/${user}/anime/${anime}`, { headers: this.headers })
      .pipe(
        map((res) => {
          if (!res.success) {
            return false;
          } else {
            return true;
          }
        })
      );
  }


  public deleteAnimeByUser(anime: number, user: number): Observable<UserAnime> {
   let headers = new HttpHeaders()
    .set('content-type', 'application/json')
    .set('Access-Control-Allow-Origin', '*')
    .set('Authorization', 'Bearer ' + localStorage.getItem('token'));
    
  
    
    return this.http.delete<UserAnime>(
      this.URL + `anime-user/${user}/anime/${anime}`,
      {
        headers: headers,
      }
    );
  }
}
