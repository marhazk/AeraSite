/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.TimerTask;
/*     */ import com.goldhuman.IO.Protocol.Manager;
/*     */ import com.goldhuman.IO.Protocol.ReconnectTask;
/*     */ import com.goldhuman.IO.Protocol.Session;
/*     */ import com.goldhuman.IO.Protocol.State;
/*     */ import java.io.PrintStream;
/*     */ 
/*     */ public final class ClientManager extends Manager
/*     */ {
/*     */   public Session s;
/*     */   private boolean conn_state;
/*  14 */   private Object locker_state = new Object();
/*     */   private static final int BACKOFF_INIT = 2;
/*     */   private static final int BACKOFF_DEADLINE = 8;
/*  17 */   private static ClientManager manager = new ClientManager();
/*     */   private int backoff;
/*     */ 
/*     */   ClientManager()
/*     */   {
/*  23 */     this.conn_state = false;
/*  24 */     this.backoff = 2;
/*     */   }
/*     */ 
/*     */   public static ClientManager GetInstance() {
/*  28 */     return manager;
/*     */   }
/*     */ 
/*     */   void Reconnect() {
/*  32 */     TimerTask.AddTimerTask(new ReconnectTask(this, 1), this.backoff);
/*  33 */     this.backoff *= 2;
/*  34 */     if (this.backoff > 8)
/*  35 */       this.backoff = 8;
/*     */   }
/*     */ 
/*     */   protected void OnAddSession(Session session) {
/*  39 */     synchronized (this.locker_state)
/*     */     {
/*  41 */       if (this.conn_state)
/*     */       {
/*  43 */         Close(session);
/*  44 */         return;
/*     */       }
/*  46 */       this.conn_state = true;
/*  47 */       this.s = session;
/*  48 */       this.backoff = 2;
/*     */     }
/*  50 */     System.out.println("ClientManager::OnAddSession,peer=" + session.getPeerAddress());
/*     */   }
/*     */ 
/*     */   protected void OnDelSession(Session session)
/*     */   {
/*  60 */     synchronized (this.locker_state)
/*     */     {
/*  62 */       this.conn_state = false;
/*  63 */       Reconnect();
/*     */     }
/*  65 */     System.out.println("ClientManager::OnDelSession,peer=" + session.getPeerAddress());
/*  66 */     this.s = null;
/*     */   }
/*     */ 
/*     */   protected void OnAbortSession(Session session)
/*     */   {
/*  76 */     synchronized (this.locker_state)
/*     */     {
/*  78 */       this.conn_state = false;
/*  79 */       Reconnect();
/*     */     }
/*  81 */     System.out.println("ClientManager::OnAbortSession,peer=" + session.getPeerAddress());
/*  82 */     this.s = null;
/*     */   }
/*     */ 
/*     */   protected State GetInitState()
/*     */   {
/*  92 */     return State.Get("normal");
/*     */   }
/*     */ 
/*     */   protected String Identification()
/*     */   {
/*  97 */     return "GameDBClient";
/*     */   }
/*     */ 
/*     */   public String identity()
/*     */   {
/* 102 */     return "zengpan";
/*     */   }
/*     */ 
/*     */   public String password()
/*     */   {
/* 107 */     return "hello";
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ClientManager
 * JD-Core Version:    0.6.2
 */