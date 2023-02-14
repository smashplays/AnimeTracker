export interface AnimeSearch {
  data: Data[];
}

export interface Data {
  mal_id: string;
  images: {
    jpg: { small_image_url: string; image_url: string };
  };
  title: string;
}
