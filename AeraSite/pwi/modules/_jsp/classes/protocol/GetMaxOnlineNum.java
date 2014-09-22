/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetMaxOnlineNum extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int maxnum;
/*    */   public int fakemaxnum;
/*    */   public int curnum;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 17 */     GetMaxOnlineNumArg arg = (GetMaxOnlineNumArg)argument;
/* 18 */     GetMaxOnlineNumRes res = (GetMaxOnlineNumRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 23 */     GetMaxOnlineNumArg arg = (GetMaxOnlineNumArg)argument;
/* 24 */     GetMaxOnlineNumRes res = (GetMaxOnlineNumRes)result;
/*    */ 
/* 26 */     synchronized (this)
/*    */     {
/* 28 */       this.retcode = res.retcode;
/* 29 */       this.maxnum = res.maxnum;
/* 30 */       this.fakemaxnum = res.fake_maxnum;
/* 31 */       this.curnum = res.curnum;
/* 32 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 38 */     synchronized (this)
/*    */     {
/* 40 */       this.retcode = 4;
/* 41 */       this.maxnum = -1;
/* 42 */       this.fakemaxnum = -1;
/* 43 */       this.curnum = -1;
/* 44 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetMaxOnlineNum
 * JD-Core Version:    0.6.2
 */