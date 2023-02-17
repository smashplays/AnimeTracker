import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Anime } from '../interfaces/anime';
import { map, Observable, of } from 'rxjs';
import { Characters } from '../interfaces/characters';
import { AnimeSearch, Data } from '../interfaces/anime-search';

@Injectable({
  providedIn: 'root',
})
export class AnimeService {
  constructor(private http: HttpClient) {}

  private animeUrl: string = 'https://api.jikan.moe/v4/anime';

  public getAnimeById(id: number): Observable<Anime> {
    return this.http
      .get<Anime>(this.animeUrl + '/' + id)
      .pipe(map((resp: Anime) => resp));
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
}
