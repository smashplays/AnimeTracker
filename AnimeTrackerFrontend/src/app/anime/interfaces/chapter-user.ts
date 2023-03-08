export interface ChapterUser {
    "data": [
        {
            "id": number,
            "watched": boolean,
            "user_id": number,
            "anime_chapter_id": number,
            "chapter": {
                "id": number,
                "name": string,
                "aired": string,
                "anime_id": number
            }
        }
    ]
}
