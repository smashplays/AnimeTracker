import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map, Observable } from 'rxjs';
import { Character } from '../interfaces/character';
import { AnimeCharacter } from '../interfaces/anime-character';

@Injectable({
  providedIn: 'root',
})

export class CharacterService {
  constructor(private http: HttpClient) {}

  private characterUrl: string = 'https://api.jikan.moe/v4/characters';

  public getCharacterById(id: number): Observable<Character> {
    return this.http
      .get<Character>(this.characterUrl + '/' + id)
      .pipe(map((resp: Character) => resp));
  }

  public getCharacterAnime(id: number): Observable<AnimeCharacter> {
    return this.http
      .get<AnimeCharacter>(this.characterUrl + '/' + id + '/anime')
      .pipe(map((resp: AnimeCharacter) => resp));
  }
}
