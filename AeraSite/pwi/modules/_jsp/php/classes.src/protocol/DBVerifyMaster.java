/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBVerifyMaster extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 14 */     DBVerifyMasterArg arg = (DBVerifyMasterArg)argument;
/* 15 */     DefFactionRes res = (DefFactionRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 20 */     DBVerifyMasterArg arg = (DBVerifyMasterArg)argument;
/* 21 */     DefFactionRes res = (DefFactionRes)result;
/*    */ 
/* 23 */     synchronized (this)
/*    */     {
/* 25 */       this.retcode = res.retcode;
/* 26 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 32 */     synchronized (this)
/*    */     {
/* 34 */       this.retcode = -1;
/* 35 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBVerifyMaster
 * JD-Core Version:    0.6.2
 */