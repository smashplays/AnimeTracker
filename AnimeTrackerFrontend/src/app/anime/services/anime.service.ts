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
import { Chapters } from '../interfaces/chapters';
import { ChapterInfo } from '../interfaces/chapter-info';

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
    name: string,
    aired: string,
    anime_id: number
  ): Observable<Chapters> {
    let data = {
      name: name,
      aired: aired,
      anime_id: anime_id,
    };
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
}
